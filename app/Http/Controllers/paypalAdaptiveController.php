<?php



namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\swap_items;
use App\Products;
use App\hunt_seller;
use App\hunt_products;
use App\Http\Requests;
use App\User;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Config;
use URL;
use File;
use Storage;
use App\hunt_commission;
use App\paypal_transactions;
use App\paypal_swap_transactions;
use App\paypal_hunt_transactions;
use App\Cart;
use Srmklive\PayPal\Services\ExpressCheckout;
use DB;
use App\invoice;
use Mail;



class paypalAdaptiveController extends Controller

{



    function postPayment(){



        if (session('usertype') !== 'buyer') {

            return redirect('/login')->with('error', 'please login to continue with payment');

        }



        $i = 0;

        $oldcart = Session::get('cart');

        $cart = new Cart($oldcart);

        $products = $cart->items;



        if ($cart->totalQty == 0) {

            return Redirect::route('product.shoppingCart')

                ->with('error', 'Please add something to your cart before proceeding to payment');

        }



        $paypalItems = array();

        $sellerAmount = 0;

        foreach ($products as $product) {

            $paypalItems[$i]['name'] = $product['item']['product_name'];

            $paypalItems[$i]['price'] = $product['item']['price_after_discount']+($product['shipping_cost'])/$product['qty'];

			$paypalItems[$i]['qty'] = $product['qty'];
      $paypalItems[$i]['shipping'] = $product['shipping_cost'];

            $sellerAmount += ($paypalItems[$i]['price']*$product['qty'])+$paypalItems[$i]['shipping'];

            $i++;

        }

		$provider = new ExpressCheckout;      // To use express checkout.

		$data = [];
		$data['items'] = $paypalItems;
		$invoice = paypal_transactions::orderBy('payment_id','Desc')->first();
		$data['invoice_id'] = date('Y-m-d H:i:s').rand(10000000, 99999999);
		$data['invoice_description'] = "Order #".$data['invoice_id']." Invoice";
		$data['return_url'] = URL::route('payment.status');
		$data['cancel_url'] = URL::route('payment.status');

		$total = 0;
		foreach($data['items'] as $item) {
			$total += ($item['price']*$item['qty']);
		}

		$data['total'] = $total;
		$response = $provider->setExpressCheckout($data);
		session::put('payment_data',$data);
		return redirect($response['paypal_link']);

	}



    function getPaymentStatus(Request $request){

		$provider = new ExpressCheckout;      // To use express checkout.
		$token = $request->input('token');
		$response = $provider->getExpressCheckoutDetails($token);
		$PayerID = $request->input('PayerID');
		$data = session::get('payment_data');
		$response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

		if($response['ACK'] == 'Success'){
			$oldcart = Session::get('cart');

        $cart = new Cart($oldcart);

        $products = $cart->items;

        $i=0;

        $paypalItems = array();

        $sellerAmount = 0;

        foreach ($products as $product) {

            $paypalItems[$i]['name'] = $product['item']['product_name'];

			$paypalItems[$i]['product_id'] = $product['item']['product_id'];
      $paypalItems[$i]['shipping'] = $product['shipping_cost'];

            $paypalItems[$i]['price'] = $product['item']['price_after_discount'];

			$paypalItems[$i]['qty'] = $product['qty'];

			$paypalItems[$i]['tot_price'] = $product['item']['price_after_discount']*$product['qty'];

            $sellerAmount += $paypalItems[$i]['tot_price']+$paypalItems[$i]['shipping'];

            $paypalItems[$i]['identifier'] = 'item_' . $i;

            $i++;

        }

		$user = User::where('user_id', Session('user_id'))->first();
		$address = $user->first_name.' '.$user->last_name.'<br>'.$user->address1.'<br>'.$user->address2.'<br>'.$user->region.'<br>'.$user->country.'<br>'.$user->postal_code.'<br>Mobile:'.$user->mobile_number;

		$html = '<div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Invoice # '.$data['invoice_id'].'</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					'.$address.'
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					'.$address.'
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					PayPal<br>
    					Transaction ID : '.$response['PAYMENTINFO_0_TRANSACTIONID'].'
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					'.date('M d, Y').'<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>';
							foreach($paypalItems as $item){

								$html .= '<tr>
    								<td>'.$item['name'].'</td>
    								<td class="text-center">$'.$item['price'].'</td>
    								<td class="text-center">'.$item['qty'].'</td>
    								<td class="text-right">$'.$item['price']*$item['qty'].'</td>
    							</tr>';
							}

							$html .= '<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$'.$item['price']*$item['qty'].'</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$'.$item['shipping'].'</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">$'.$sellerAmount.'</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>';

	$invoice = new invoice;
	$invoice->invoice_number = $data['invoice_id'];
	$invoice->invoice = $html;
	$invoice->save();
	$invoice_id = $invoice->id;

        for($i=0; $i<count($paypalItems); $i++) {

            $name = $paypalItems[$i]['product_id'];

            $seller = Products::where('product_id', $name)->select('seller_id', 'product_id', 'sell_type_id')->first();



            $payments = new paypal_transactions;

            $payments->transaction_id = $response['PAYMENTINFO_0_TRANSACTIONID'];

            $payments->amount_paid = $paypalItems[$i]['price'];

            $payments->buyer_id = session('user_id');

            $payments->shipping_cost = $item['shipping'];

            $payments->seller_id = $seller->seller_id;

            $payments->product_id = $seller->product_id;

            $payments->mode_of_selling_id = $seller->sell_type_id;

            $payments->status = 'completed';

            $payments->quantity = $paypalItems[$i]['qty'];

			$payments->invoice_id = $invoice_id;

            $payments->save();

            Session::forget('cart');

        }

			$userData = User::where('user_id', Session('user_id'))->first();

			$data = array('email'=>$userData->email, 'name'=>$userData->first_name);

			Mail::send('mails.sell-invoice', ['invoice'=>$html, 'user_id'=>$userData->user_id], function($message) use($data)

			{

				$message->from('testmail0987654@gmail.com', 'Bubiland');

				$message->to($data['email'], $data['name'])->subject('Invoice');

			});

      $seller_email = DB::table('users')->where('user_id',$seller->seller_id)->first();

      // 'contents' key in array matches variable name used in view
      $data = array('email'=>$seller_email->email, 'name'=>$seller_email->first_name);

      $link = URL::to('/')."/invoice/".$invoice_id;

      $content = "Dear ".$seller_email->first_name." <br> Please refer to the below link to get product details of sold product:<br>".$link."<br>Thank You";

			Mail::send('mails.no-view', ['content'=>$content], function($message) use($data)

			{

				$message->from('testmail0987654@gmail.com', 'Bubiland');

				$message->to($data['email'], $data['name'])->subject('Order Confirmation');

			});

            return view('order-summary-sell')

                ->with([
						'success'=>'Payment success. Your transaction Id is:' . $response['PAYMENTINFO_0_TRANSACTIONID'],
						'invoice'=>$html,
						'userData'=>$userData,
					   ]);
		}

        else{



            return Redirect::route('product.shoppingCart')

            ->with('error', 'Payment failed');

        }

    }



    function splitPaySwapSeller($id){

    	if (session('usertype') !== 'buyer') {

            return redirect('/login')->with('error', 'please login to continue with payment');

        }



        $seller = User::where('user_id', session('user_id'))->first();

        $swap = swap_items::where('swap_id', $id)->first();

        session(['swap_id' => $id]);



        if ($seller->user_id != $swap->seller_id || $swap->status == 1) {

            return redirect('/buyerdashboard')->with('error', 'You are not authorized for this transaction');

        }



        $sellerAmount = $swap->product_price;

		$provider = new ExpressCheckout;      // To use express checkout.

		$data = [];
		$data['items'] = [
							[
								'name'=>$swap->product_name,
								'price'=>$sellerAmount,
								'qty'=>1
							]
						 ];
		$invoice = paypal_swap_transactions::orderBy('paypal_swap_id','Desc')->first();
		$data['invoice_id'] = date('Y-m-d H:i:s').rand(10000000, 99999999);
		$data['invoice_description'] = "Order #".$data['invoice_id']." Invoice";
		$data['return_url'] = URL::route('payment.sellerswapstatus');
		$data['cancel_url'] = URL::route('payment.sellerswapstatus');

		$total = 0;
		foreach($data['items'] as $item) {
			$total += $item['price']*$item['qty'];
		}

		$data['total'] = $total;

		$response = $provider->setExpressCheckout($data);
		session::put('payment_data',$data);
		Session::put('swap_id', $id);
		return redirect($response['paypal_link']);

    }



    function viewreportSwapSeller(Request $request){

    	$id = session('swap_id');

		$provider = new ExpressCheckout;      // To use express checkout.
		$token = $request->input('token');
		$response = $provider->getExpressCheckoutDetails($token);
		$PayerID = $request->input('PayerID');
		$data = session::get('payment_data');
		$response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

		if($response['ACK'] == 'Success'){

            swap_items::where('swap_id', $id)->update(['status' => '1']);

            $swap_payments = new paypal_swap_transactions;

            $swap_payments->seller_id = session('user_id');

            $swap_payments->seller_transaction_id = $response['PAYMENTINFO_0_TRANSACTIONID'];

            $swap_payments->seller_product_id = $id;

            $swap_payments->seller_amount_paid = $response['PAYMENTINFO_0_AMT'];

            $swap_payments->seller_status = 1;

            $swap_payments->save();



            return Redirect('/buyerdashboard/view-swap-request')

                ->with('success', 'Payment success. Your transaction Id is:' . $response['PAYMENTINFO_0_TRANSACTIONID']);

    	}

    	else{



    		return Redirect('/buyerdashboard/view-swap-request')

            ->with('error', 'Payment failed');

    	}

    }



    function splitPaySwapBuyer($id){

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



        $buyerAmount = $product->price_after_discount;

		$provider = new ExpressCheckout;      // To use express checkout.

		$data = [];
		$data['items'] = [
							[
								'name'=>$product->product_name,
								'price'=>$buyerAmount,
								'qty'=>1
							]
						 ];

		$data['invoice_id'] = date('Y-m-d H:i:s').rand(10000000, 99999999);
		$data['invoice_description'] = "Order #".$data['invoice_id']." Invoice";
		$data['return_url'] = URL::route('payment.buyerswapstatus');
		$data['cancel_url'] = URL::route('payment.buyerswapstatus');

		$total = 0;
		foreach($data['items'] as $item) {
			$total += $item['price']*$item['qty'];
		}

		$data['total'] = $total;

		$response = $provider->setExpressCheckout($data);
		session::put('payment_data',$data);
		session::put('swap_id',$id);
		session::put('buyer_product_id',$swap->for_product_id);
		return redirect($response['paypal_link']);

    }



    function viewreportSwapBuyer(Request $request){

    	$product_id = session('buyer_product_id');

    	$id = session('swap_id');

		$provider = new ExpressCheckout;      // To use express checkout.
		$token = $request->input('token');
		$response = $provider->getExpressCheckoutDetails($token);
		$PayerID = $request->input('PayerID');
		$data = session::get('payment_data');
		$response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

		if($response['ACK'] == 'Success'){

    		$id = session('swap_id');

            swap_items::where('swap_id', $id)->update(['buyer_paid' => '1']);

            paypal_swap_transactions::where('seller_product_id', $id)->update(['buyer_id'=>session('user_id'), 'buyer_transaction_id'=>$response['PAYMENTINFO_0_TRANSACTIONID'], 'buyer_product_id'=>$product_id,'buyer_amount_paid'=>$response['PAYMENTINFO_0_AMT'], 'buyer_status'=>1]);



            return Redirect('/buyerdashboard/view-confirm-swap-request')

                ->with('success', 'Payment success. Item successfully swapped. Your transaction Id is:' . $response['PAYMENTINFO_0_TRANSACTIONID']);

    	}

    	else{



    		return Redirect('/buyerdashboard/view-confirm-swap-request')

            ->with('error', 'Payment failed');

    	}

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

        $incamount = $buyerhunt->product_price;

		$provider = new ExpressCheckout;      // To use express checkout.

		$data = [];
		$data['items'] = [
							[
								'name'=>$buyerhunt->product_name,
								'price'=>$incamount,
								'qty'=>1
							]
						 ];

		$data['invoice_id'] = date('Y-m-d H:i:s').rand(10000000, 99999999);
		$data['invoice_description'] = "Order #".$data['invoice_id']." Invoice";
		$data['return_url'] = URL::route('payment.buyerhuntstatus');
		$data['cancel_url'] = URL::route('payment.buyerhuntstatus');

		$total = 0;
		foreach($data['items'] as $item) {
			$total += $item['price']*$item['qty'];
		}

		$data['total'] = $total;

		$response = $provider->setExpressCheckout($data);
		session::put('payment_data',$data);
		Session::put('hunt_id', $buyerhunt->hunt_id);
        Session::put('product_id', $id);
        Session::put('buyer_amount', $incamount);
		return redirect($response['paypal_link']);

    }

    public function getBuyerHuntPaymentStatus(Request $request)
    {
        $hunt_id = Session::get('hunt_id');
        $product_id = Session::get('product_id');

		$provider = new ExpressCheckout;      // To use express checkout.
		$token = $request->input('token');
		$response = $provider->getExpressCheckoutDetails($token);
		$PayerID = $request->input('PayerID');
		$data = session::get('payment_data');
		$response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);

		if($response['ACK'] == 'Success'){

    		$id = session('swap_id');

            swap_items::where('swap_id', $id)->update(['buyer_paid' => '1']);

            paypal_swap_transactions::where('seller_product_id', $id)->update(['buyer_id'=>session('user_id'), 'buyer_transaction_id'=>$response['PAYMENTINFO_0_TRANSACTIONID'], 'buyer_product_id'=>$product_id,'buyer_amount_paid'=>$response['PAYMENTINFO_0_AMT'], 'buyer_status'=>1]);

            hunt_seller::where('product_id', $product_id)->update(['product_status'=>0, 'seller_confirm_status'=>1]);

			$seller = hunt_seller::where('product_id', $product_id)->first();

            $hunt_payment = new paypal_hunt_transactions;
            $hunt_payment->buyer_id = session('user_id');
            $hunt_payment->for_product_id = $hunt_id;
            $hunt_payment->buyer_product_id = $product_id;
            $hunt_payment->buyer_amount_paid = $response['PAYMENTINFO_0_AMT'];
			$hunt_payment->buyer_transaction_id = $response['PAYMENTINFO_0_TRANSACTIONID'];
            $hunt_payment->seller_id = $seller->created_by;

            $hunt_payment->save();
            Session::forget('buyer_amount');

            return Redirect('/buyerdashboard/view-hunt/'.$hunt_id)
                ->with('success', 'Payment success. Notification sent to the seller. Your transaction Id is:'.$response['PAYMENTINFO_0_TRANSACTIONID']);
        }
        return Redirect('/buyerdashboard/view-hunt/'.$hunt_id)
            ->with('error', 'Payment failed');
    }

}
