<?php

namespace App\Http\Controllers;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\User;
use App\swap_items;
use App\Products;
use App\hunt_seller;
use App\hunt_products;
use DB;
use App\hunt_commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Cart;
use Session;
use Config;
use URL;
use File;
use Storage;
use App\paypal_transactions;
use App\paypal_swap_transactions;
use App\paypal_hunt_transactions;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment()
    {
        if (session('usertype') !== 'buyer') {
            return redirect('/login')->with('error', 'please login to continue with payment');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $i = 0;
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        $products = $cart->items;

        if ($cart->totalQty == 0) {
            return Redirect::route('product.shoppingCart')
                ->with('error', 'Please add something to your cart before proceeding to payment');
        }

        $paypalItems = array();

        foreach ($products as $product) {
            $i++;
            $item = 'item_' . $i;
            $$item = new Item();
            $$item->setName($product['item']['product_name'])// item name
            ->setCurrency('USD')
                ->setQuantity($product['qty'])
                ->setPrice($product['item']['price_after_discount']);
            array_push($paypalItems, $$item);
        }
        // add item to list
        $allitems = $paypalItems;
        $item_list = new ItemList();
        $item_list->setItems($allitems);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($cart->totalPrice);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect::route('product.shoppingCart')
            ->with('error', 'Unknown error occurred');
    }

    public function getPaymentStatus()
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect::route('product.shoppingCart')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made

            $data = json_decode($result, true);

            $product = $data['transactions'][0]['item_list']['items'];

            foreach ($product as $products) {
                $name = $products['name'];
                $price = $products['price'];
                $quantity = $products['quantity'];
                $seller = Products::where('product_name', $name)->select('seller_id', 'product_id', 'sell_type_id')->first();

                $payments = new paypal_transactions;
                $payments->transaction_id = $payment->getId();
                $payments->amount_paid = $price;
                $payments->paypal_email = $data['payer']['payer_info']['email'];
                $payments->buyer_id = session('user_id');
                $payments->seller_id = $seller->seller_id;
                $payments->product_id = $seller->product_id;
                $payments->mode_of_selling_id = $seller->sell_type_id;
                $payments->status = 'completed';
                $payments->quantity = $quantity;
                $payments->save();
                Session::forget('cart');
            }


            return Redirect::route('product.shoppingCart')
                ->with('success', 'Payment success. Your transaction Id is:' . $payment->getId());
        }

        return Redirect::route('product.shoppingCart')
            ->with('error', 'Payment failed');
    }

    public function postPaymentSwapSeller($id)
    {
        if (session('usertype') !== 'buyer') {
            return redirect('/login')->with('error', 'please login to continue with payment');
        }

        $seller = User::where('user_id', session('user_id'))->first();
        $swap = swap_items::where('swap_id', $id)->first();
        session(['swap_id' => $id]);

        if ($seller->user_id != $swap->seller_id || $swap->status == 1) {
            return redirect('/buyerdashboard')->with('error', 'You are not authorized for this transaction');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $incamount = $swap->product_price + 2.5;
        $item = new Item();
        $item->setName($swap->product_name)// item name
        ->setCurrency('USD')
            ->setQuantity('1')
            ->setPrice($incamount);

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array(($item)));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($incamount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.sellerswapstatus'))
            ->setCancelUrl(URL::route('payment.sellerswapstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('seller_amount', $incamount);

        if (isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect('/buyerdashboard/view-swap-request')
            ->with('error', 'Unknown error occurred');
    }

    public function getSellerSwapPaymentStatus()
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect('/buyerdashboard/view-swap-request')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            $id = session('swap_id');
            swap_items::where('swap_id', $id)->update(['status' => '1']);

            $swap_payments = new paypal_swap_transactions;
            $swap_payments->seller_id = session('user_id');
            $swap_payments->seller_transaction_id = $payment->getId();
            $swap_payments->seller_product_id = $id;
            $swap_payments->seller_amount_paid = session('seller_amount');
            $swap_payments->save();
            Session::forget('seller_amount');

            return Redirect('/buyerdashboard/view-swap-request')
                ->with('success', 'Payment success. Your transaction Id is:' . $payment->getId());
        }
        return Redirect('/buyerdashboard/view-swap-request')
            ->with('error', 'Payment failed');
    }

    public function postPaymentSwapBuyer($id)
    {
        if (session('usertype') !== 'buyer') {
            return redirect('/login')->with('error', 'please login to continue with payment');
        }

        $buyer = User::where('user_id', session('user_id'))->first();
        $swap = swap_items::where('swap_id', $id)->first();
        $product = Products::where('product_id', $swap->for_product_id)->first();
        session(['swap_id' => $id]);

        if ($buyer->user_id != $swap->buyer_id || $swap->status == 0 || $swap->buyer_paid == 1) {
            return redirect('/buyerdashboard')->with('error', 'You are not authorized for this transaction');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $incamount = $product->price_after_discount + 2.5;
        $item = new Item();
        $item->setName($product->product_name)// item name
        ->setCurrency('USD')
            ->setQuantity('1')
            ->setPrice($incamount);

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array(($item)));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($incamount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.buyerswapstatus'))
            ->setCancelUrl(URL::route('payment.buyerswapstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('buyer_product_id', $swap->for_product_id);
        Session::put('buyer_amount', $incamount);

        if (isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect('/buyerdashboard/view-confirm-swap-request')
            ->with('error', 'Unknown error occurred');
    }

    public function getBuyerSwapPaymentStatus()
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect('/buyerdashboard/view-confirm-swap-request')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            $id = session('swap_id');
            swap_items::where('swap_id', $id)->update(['buyer_paid' => '1']);

            paypal_swap_transactions::where('seller_product_id', $id)->update(['buyer_id'=>session('user_id'), 'buyer_transaction_id'=>$payment->getId(), 'buyer_product_id'=>session('buyer_product_id'), 'buyer_amount_paid'=>session('buyer_amount')]);

            Session::forget('buyer_amount');
            Session::forget('buyer_product_id');

            return Redirect('/buyerdashboard/view-confirm-swap-request')
                ->with('success', 'Payment success. Item successfully swapped. Your transaction Id is:' . $payment->getId());
        }
        return Redirect('/buyerdashboard/view-confirm-swap-request')
            ->with('error', 'Payment failed');
    }

    public function buyer_confirm_hunt($id){
        if(session('usertype') !== 'buyer'){
            return redirect('/login')->with('error','please login to continue with payment');
        }

        $buyerhunt = hunt_seller::where('product_id', $id)->first();
        $product = DB::select(DB::raw('select hunt_sellers.*, hunt_products.created_by as buyer_id from hunt_sellers left join hunt_products on hunt_sellers.hunt_id = hunt_products.hunt_id where hunt_products.created_by = '.session('user_id').' and hunt_sellers.product_id = '.$id));

        if(count($product) != 1){
            return redirect('buyerdashboard/view-hunt-request')->with('error', 'nothing to confirm');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $incamount = $buyerhunt->product_price;
        $item = new Item();
        $item->setName($buyerhunt->product_name) // item name
        ->setCurrency('USD')
            ->setQuantity('1')
            ->setPrice($incamount);

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array(($item)));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($incamount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.buyerhuntstatus'))
            ->setCancelUrl(URL::route('payment.buyerhuntstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('hunt_id', $buyerhunt->hunt_id);
        Session::put('product_id', $id);
        Session::put('buyer_amount', $incamount);

        if(isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect('/buyerdashboard/view-hunt/'.$buyerhunt->hunt_id)
            ->with('error', 'Unknown error occurred');
    }

    public function getBuyerHuntPaymentStatus()
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');
        $hunt_id = Session::get('hunt_id');
        $product_id = Session::get('product_id');
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        Session::forget('hunt_id');
        Session::forget('product_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect('/buyerdashboard/view-hunt/'.$hunt_id)
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made

            hunt_seller::where('product_id', $product_id)->update(['product_status'=>0, 'seller_confirm_status'=>0]);

            $hunt_payment = new paypal_hunt_transactions;
            $hunt_payment->buyer_id = session('user_id');
            $hunt_payment->for_product_id = $hunt_id;
            $hunt_payment->buyer_product_id = $product_id;
            $hunt_payment->buyer_amount_paid = session('buyer_amount');
            $hunt_payment->buyer_transaction_id = $payment->getId();
            $hunt_payment->save();
            Session::forget('buyer_amount');

            return Redirect('/buyerdashboard/view-hunt/'.$hunt_id)
                ->with('success', 'Payment success. Notification sent to the seller. Your transaction Id is:'.$payment->getId());
        }
        return Redirect('/buyerdashboard/view-hunt/'.$hunt_id)
            ->with('error', 'Payment failed');
    }

    public function seller_confirm_hunt($id){
        if(session('usertype') !== 'buyer'){
            return redirect('/login')->with('error','please login to continue with payment');
        }

        $sellerhunt = hunt_seller::where('product_id', $id)->first();
        $product = DB::select(DB::raw('select hunt_sellers.*, hunt_products.created_by as buyer_id from hunt_sellers left join hunt_products on hunt_sellers.hunt_id = hunt_products.hunt_id where hunt_sellers.created_by = '.session('user_id').' and hunt_sellers.product_id = '.$id));

        if(count($product) != 1){
            return redirect('buyerdashboard/view-confirm-hunt-request')->with('error', 'nothing to confirm');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = $sellerhunt->product_price;
        $commission = hunt_commission::first();

        $percent = $commission->percentage;
        $fixed = $commission->fixed;
        $max = $commission->maximum;

        $percentamount = ($amount/100)*$percent;
        if($percentamount > $fixed){
            if($percentamount > $max){
                $incamount = $max;
            }
            else{
                $incamount = $percentamount;
            }
        }
        else{
            $incamount = $fixed;
        }

        $item = new Item();
        $item->setName('commission for'.$sellerhunt->product_name) // item name
        ->setCurrency('USD')
            ->setQuantity('1')
            ->setPrice($incamount);

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array(($item)));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($incamount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.sellerhuntstatus'))
            ->setCancelUrl(URL::route('payment.sellerhuntstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('hunt_id', $sellerhunt->hunt_id);
        Session::put('product_id', $id);
        Session::put('seller_amount', $incamount);

        if(isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }

        return Redirect('/buyerdashboard/view-hunt/'.$buyerhunt->hunt_id)
            ->with('error', 'Unknown error occurred');
    }

    public function getSellerHuntPaymentStatus()
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');
        $hunt_id = Session::get('hunt_id');
        $product_id = Session::get('product_id');
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        Session::forget('hunt_id');
        Session::forget('product_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect('/buyerdashboard/view-confirm-hunt-request')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made

            hunt_seller::where('product_id', $product_id)->update(['seller_confirm_status'=>1]);

            paypal_hunt_transactions::where('buyer_product_id', $product_id)->update(['seller_transaction_id'=>$payment->getId(), 'seller_product_id'=>$product_id, 'seller_amount_paid'=>session('seller_amount'), 'seller_id'=>session('user_id')]);
            session::forget('seller_amount');

            return Redirect('/buyerdashboard/view-confirm-hunt-request')
                ->with('success', 'Payment success. Notification sent to buyer. Your transaction Id is:'.$payment->getId());
        }
        return Redirect('/buyerdashboard/view-confirm-hunt-request')
            ->with('error', 'Payment failed');
    }
}