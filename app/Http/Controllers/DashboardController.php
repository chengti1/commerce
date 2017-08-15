<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\User;
use App\user_messages;
use App\Categories;
use DB;
use App\hunt_seller;
use App\Subcategories;
use App\Products;
use App\swap_items;
use App\paymentMethods;
use App\hunt_products;
use App\seller_payment_methods;
use App\selltype;
use Hash;
use App\create_coupon_code;
use Illuminate\Support\Facades\Validator;
use App\paypal_transactions;
use App\coupon_code_rules;

class DashboardController extends Controller
{
    public function changeSellerPassword(){
    	session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
    		return view('sellerChangePassword')->with('userData',$userData);
    	}
    	else{
    		return redirect('login');
    	}
    }

    public function dochangeSellerPassword(Request $request){
    	session()->regenerate();
        if(session('usertype') == 'buyer'){
        	$user = User::where('user_id', Session('user_id'))->first();
        	if(Hash::check($request->password, $user->password)){
        		User::where('user_id', Session('user_id'))->update(['password' => bcrypt($request->input('newpassword'))]);
                return redirect('/buyerdashboard/changesellerpassword')->with('success', 'Password Changed!');
        	}
            else{
                return redirect('/buyerdashboard/changesellerpassword')->with('error', 'Invalid Password Entered!');
            }
        }
        else{
    		return redirect('login');
    	}
    }

    public function dochangepmethod(Request $request){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $user = User::where('user_id', Session('user_id'))->first();
            if($request->has('pmethod')){
                User::where('user_id', session('user_id'))->update(['payment_method' => $request->input('pmethod')]);
                return redirect('buyerdashboard/changepmethod');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function changepmethod(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $user = User::where('user_id', Session('user_id'))->first();
            $payments = DB::table('seller_payment_methods')->leftJoin('payment_methods', 'seller_payment_methods.payment_method_id', '=', 'payment_methods.payment_method_id')->where('seller_payment_methods.seller_id',session('user_id'))->get();

            return view('changepmethod')->with('userData',$user)->with('payments',$payments);
        }
        else{
            return redirect('login');
        }
    }

    public function updateprofile(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $user = User::where('user_id', Session('user_id'))->first();
            return view('updateprofile')->with('userData',$user);
        }
        else{
            return redirect('login');
        }
    }

    public function doupdateprofile(Request $request){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $validator = Validator::make($request->all(), [
                'fname'=>'required|max:50',
                'lname'=>'required|max:50',
                'paypalemail'=>'required|max:100|email',
                'company'=>'max:100|string',
                'add1'=>'required|max:50',
                'add2'=>'max:50',
                'country'=>'required|max:50',
                'pcode'=>'required|max:50',
                'region'=>'required|max:50',
            ]);
            if ($validator->fails()) {
             return redirect('/buyerdashboard/updateprofile')->with('errors',$validator->errors());
            }
            else{

                User::where('user_id', session('user_id'))->update(['first_name' => $request->input('fname'), 'last_name' => $request->input('lname'), 'address1' => $request->input('add1'), 'address2' => $request->input('add2'), 'Company' => $request->input('company'), 'region' => $request->input('region'), 'postal_code' => $request->input('pcode'), 'country' => $request->input('country'), 'paypal_email' => $request->input('paypalemail')]);
                return redirect('/buyerdashboard/updateprofile')->with('success', 'Profile Updated!');

        }
    }
    else{
            return redirect('login');
        }
    }

    public function sellitem(){
       session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $category = Categories::where('parent_id','0')->get();
            $selltype = selltype::get();
            return view('sellitem')->with('categories',$category)->with('userData',$userData)->with('selltype',$selltype);
        }
        else{
            return redirect('login');
        }
    }

    public function getsubcategory(Request $request){
        $subcategory = Categories::where('parent_id',$request->input('category_id'))->get();
        $result = '';
        foreach($subcategory as $subcategories){
            $result .= '<option value = "'.$subcategories->category_id.'">'.$subcategories->category_name.'</option>';
        }
        return $result;
    }

    public function deletepmethod(Request $request){
        session()->regenerate();
        if(session('usertype') == 'buyer' && session('user_id') == $request->input('sellerid')){
            seller_payment_methods::where('seller_id',$request->input('sellerid'))->where('payment_method_id',$request->input('id'))->delete();
            return redirect('/buyerdashboard/changepmethod')->with('success', 'Payment Method Deleted!');
        }
        else{
            return redirect('login');
        }
    }

    public function addpmethod(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $paymentmethods = paymentMethods::get();
            return view('addpmethod')->with('userData',$userData)->with('paymentmethods',$paymentmethods);
        }
        else{
            return redirect('login');
        }
    }

    public function doaddpmethod(Request $request){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $validator = Validator::make($request->all(), [
                'method'=>'required|max:50|exists:payment_methods,payment_method_id|unique:seller_payment_methods,payment_method_id,NULL,NULL,seller_id,'.session('user_id').'',
            ]);
            if ($validator->fails()) {
             return redirect('/buyerdashboard/addpmethod')->with('errors',$validator->errors());
            }
            else{

                $payment = new seller_payment_methods;
                $payment->seller_id = session('user_id');
                $payment->payment_method_id = $request->input('method');
                $payment->created_by = session('user_id');
                $payment->updated_by = session('user_id');
                $payment->save();

                return redirect('/buyerdashboard/changepmethod')->with('success', 'Profile Updated!');

        }
        }
        else{
            return redirect('login');
        }
    }

    public function huntanitem(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $categories = Categories::where('parent_id', 0)->get();
            return view('huntanitem')->with('userData', $userData)->with('categories', $categories);
        }
        else{
            return redirect('login');
        }
    }

    public function dohuntanitem(Request $request){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $validator = Validator::make($request->all(), [
                'image'=>'required|dimensions:min_width=500,min_height=500|mimes:jpeg,bmp,png,jpg',
                'image1'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
                'image2'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
                'image3'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
                'productname'=>'required|max:100|unique:hunt_products,product_name',
                'category'=>'required|max:50|exists:categories,category_id',
                'scategory'=>'required|max:50|exists:categories,category_id',
                'price'=>'required|numeric|min:0',
                'swap'=>'required|numeric|min:0|max:1',
                'description'=>'required',
                'keywords' => 'required|max:500',
            ]);
            if ($validator->fails()) {
             return redirect('/buyerdashboard/hunt-an-item')->with('errors',$validator->errors());
            }
            else{
                $destinationPath = base_path() . '/public/images/product_hunt/';
                $current_time = Carbon::now();
                $extension = $request->file('image')->getClientOriginalExtension();
                $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second;
                $fileName = $date.'.'.$extension;
                $request->file('image')->move($destinationPath, $fileName);

                if($request->file('image1')){
                    $current_time = Carbon::now();
                    $extension = $request->file('image1')->getClientOriginalExtension();
                    $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'1';
                    $fileName1 = $date.'.'.$extension;
                    $request->file('image1')->move($destinationPath, $fileName1);
                }
                if($request->file('image2')){
                    $current_time = Carbon::now();
                    $extension = $request->file('image2')->getClientOriginalExtension();
                    $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'2';
                    $fileName2 = $date.'.'.$extension;
                    $request->file('image2')->move($destinationPath, $fileName2);
                }
                if($request->file('image3')){
                    $current_time = Carbon::now();
                    $extension = $request->file('image3')->getClientOriginalExtension();
                    $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'3';
                    $fileName3 = $date.'.'.$extension;
                    $request->file('image3')->move($destinationPath, $fileName3);
                }

                $hunt = new hunt_products;
                if($request->file('image1')){
                    $hunt->product_image_1 = $fileName1;
                }
                if($request->file('image2')){
                    $hunt->product_image_2 = $fileName2;
                }
                if($request->file('image3')){
                    $hunt->product_image_3 = $fileName3;
                }
                $hunt->product_name = $request->input('productname');
                $hunt->product_category = $request->input('category');
                $hunt->product_subcategory = $request->input('scategory');
                $hunt->product_image = $fileName;
                $hunt->product_description = $request->input('description');
                $hunt->product_swap = $request->input('swap');
                $hunt->product_keywords = $request->input('keywords');
                $hunt->product_price = $request->input('price');
                $hunt->created_by = session('user_id');
                $hunt->updated_by = session('user_id');
                $hunt->save();
                return redirect('/buyerdashboard/hunt-an-item')->with('success', 'Your product listed.. We will message you once we find a desired seller..!!');
            }
        }
        else
        {
            return redirect('login');
        }
    }

    public function user_messages(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
           $userData = User::where('user_id', session('user_id'))->first();
           $message = DB::select(DB::raw('select user_messages.*, users.first_name from user_messages left join users on users.user_id = user_messages.sender_id where user_messages.receiver_id = '.session('user_id')));
           return view('user-messages')->with('messages', $message)->with('userData',$userData);
        }
        else{
            return redirect('login');
        }
        }

    public function swapconfirmbuyer(Request $request, $id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $validator = Validator::make($request->all(), [
                'image'=>'required|mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
                'productname'=>'required|max:100|unique:swap_items,product_name',
                'price'=>'required|numeric|min:0',
                'description'=>'required|max:500',
                'image1'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
                'image2'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
                'image3'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
            ]);
            if ($validator->fails()) {
             return $validator->errors()->first();
            }
            else{
                $seller_id = Products::where('product_id', $id)->first();
                $destinationPath = base_path() . '/public/images/product_swap_request/';
                $current_time = Carbon::now();
                $extension = $request->file('image')->getClientOriginalExtension();
                $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second;
                $fileName = $date.'.'.$extension;
                $request->file('image')->move($destinationPath, $fileName);
                if($request->file('image1')){
                  $current_time = Carbon::now();
                  $extension = $request->file('image1')->getClientOriginalExtension();
                  $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'1';
                  $fileName1 = $date.'.'.$extension;
                  $request->file('image1')->move($destinationPath, $fileName1);
              }
              if($request->file('image2')){
                  $current_time = Carbon::now();
                  $extension = $request->file('image2')->getClientOriginalExtension();
                  $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'2';
                  $fileName2 = $date.'.'.$extension;
                  $request->file('image2')->move($destinationPath, $fileName2);
              }
              if($request->file('image3')){
                  $current_time = Carbon::now();
                  $extension = $request->file('image3')->getClientOriginalExtension();
                  $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'3';
                  $fileName3 = $date.'.'.$extension;
                  $request->file('image3')->move($destinationPath, $fileName3);
              }
                $swap_item = new swap_items;
                if($request->file('image1')){
                  $swap_item->product_image_1 = $fileName1;
              }
              if($request->file('image2')){
                  $swap_item->product_image_2 = $fileName2;
              }
              if($request->file('image3')){
                  $swap_item->product_image_3 = $fileName3;
              }
                $swap_item->buyer_id = session('user_id');
                $swap_item->seller_id = $seller_id->seller_id;
                $swap_item->product_name = $request->input('productname');
                $swap_item->product_image = $fileName;
                $swap_item->product_description = $request->input('description');
                $swap_item->product_price = $request->input('price');
                $swap_item->created_by = session('user_id');
                $swap_item->updated_by = session('user_id');
                $swap_item->status = 0;
                $swap_item->buyer_paid = 0;
                $swap_item->for_product_id = $id;
                $swap_item->save();
                return 'Request sent to the seller, We will get back to you soon when the seller confirms';
            }
        }
        return 'Please login to continue';
    }

    public function viewswaprequest(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $swap_request = DB::select(DB::raw('select swap_items.*, products.product_name as old_product_name, products.product_id as old_product_id from swap_items left join products on products.product_id = swap_items.for_product_id where swap_items.seller_id = '.session('user_id')));
            return view('swap_request')->with('userData', $userData)->with('swap_request', $swap_request);
        }
        else{
            return redirect('login');
        }
    }

    public function viewconfirmswaprequest(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $swap_request = DB::select(DB::raw('select swap_items.*, products.product_name as old_product_name, products.product_id as old_product_id, products.product_images as old_product_images, products.price_after_discount as old_price_after_discount, products.product_description as old_product_description from swap_items left join products on products.product_id = swap_items.for_product_id where swap_items.buyer_id = '.session('user_id').' and swap_items.status = 1'));
            return view('swap_confirm_request')->with('userData', $userData)->with('swap_request', $swap_request);
        }
        else{
            return redirect('login');
        }
    }

    public function sell_leads(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $sell = DB::select(DB::raw('SELECT paypal_transactions.*, users.first_name, selltypes.sell_type, products.product_name from paypal_transactions left join users on users.user_id = paypal_transactions.buyer_id left join selltypes on selltypes.sell_type_id = paypal_transactions.mode_of_selling_id left join products on products.product_id = paypal_transactions.product_id where paypal_transactions.seller_id = '.session('user_id')));
            return view('sell-leads')->with('userData', $userData)->with('sell', $sell);
        }
        else{
            return redirect('login');
        }
    }

    public function buy_leads(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $buy = DB::select(DB::raw('SELECT paypal_transactions.*, users.first_name, selltypes.sell_type, products.product_name from paypal_transactions left join users on users.user_id = paypal_transactions.seller_id left join selltypes on selltypes.sell_type_id = paypal_transactions.mode_of_selling_id left join products on products.product_id = paypal_transactions.product_id where paypal_transactions.buyer_id = '.session('user_id')));
            return view('buy-leads')->with('userData', $userData)->with('buy', $buy);
        }
        else{
            return redirect('login');
        }
    }

    public function delete_message($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $message = user_messages::where('message_id', $id)->first();
            if(count($message) == 0){
                return redirect('/buyerdashboard/messages');
            }
            if($message->receiver_id != session('user_id')){
                return redirect('/buyerdashboard')->with('error','You are not authorized');
            }
            user_messages::where('message_id', $id)->delete();
            return redirect('/buyerdashboard/messages')->with('success', 'message deleted');
        }
        else{
            return redirect('login');
        }
    }

    public function managepattributes(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $attribute_groups = DB::table('attribute_groups')->where([
              'seller_id'=>session('user_id'),
              'parent_id'=>0
            ])->get();
            return view('managepattributes')->with('userData', $userData)->with('attribute_groups', $attribute_groups);
        }
        else{
            return redirect('login');
        }
    }

    public function manage_coupons(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){
                $coupons = create_coupon_code::where('created_by', session('user_id'))->get();
                return view('seller.manage_coupons')->with('userData', $userData)->with('coupons', $coupons);
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function add_coupons(){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){
                return view('seller.add-coupons')->with('userData', $userData);
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function doadd_coupons(Request $request){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){
                if($request->input('discount_option') == 1){
                    $validator = Validator::make($request->all(), [
                'title'=>'required|max:500|unique:create_coupon_codes,title',
                'code'=>'required|max:100|unique:create_coupon_codes,coupon_code',
                'start'=>'required|date|after:yesterday',
                'end'=>'required|date|after:start',
                'discount_option'=>'required|numeric|max:1|min:0',
                'discount'=>'required|numeric|min:0|max:100'
            ]);
                }
                else{
                    $validator = Validator::make($request->all(), [
                'title'=>'required|max:500|unique:create_coupon_codes,title',
                'code'=>'required|max:100|unique:create_coupon_codes,coupon_code',
                'start'=>'required|date|after:yesterday',
                'end'=>'required|date|after:start',
                'discount_option'=>'required|numeric|max:1|min:0',
                'discount'=>'required|numeric|min:0'
            ]);
                }
            if ($validator->fails()) {
             return redirect('/buyerdashboard/add-coupon')->with('errors',$validator->errors())->withInput();
            }
            else{
                $create_coupon_code = new create_coupon_code;
                $create_coupon_code->title = $request->input('title');
                $create_coupon_code->coupon_code = $request->input('code');
                $create_coupon_code->start_date = $request->input('start');
                $create_coupon_code->end_date = $request->input('end');
                $create_coupon_code->is_visible_to_seller = 1;
                $create_coupon_code->is_visible_to_buyer = 1;
                $create_coupon_code->is_visible_to_public = 1;
                $create_coupon_code->discount = $request->input('discount');
                if($request->input('discount_option') == 1){
                    $create_coupon_code->is_percentage = 1;
                    $create_coupon_code->is_fixed = 0;
                }
                else{
                    $create_coupon_code->is_percentage = 0;
                    $create_coupon_code->is_fixed = 1;
                }
                $create_coupon_code->created_by = session('user_id');
                $create_coupon_code->updated_by = session('user_id');
                $create_coupon_code->role_id = 3;
                $create_coupon_code->save();
                return redirect('/buyerdashboard/manage-coupons')->with('success', 'Coupon added successfully');
            }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function delete_coupon($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){

                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by == session('user_id')){
                    coupon_code_rules::where('coupon_id', $id)->delete();
                    create_coupon_code::where('coupon_id', $id)->delete();
                    return redirect('/buyerdashboard/manage-coupons')->with('success', 'Coupon deleted successfully');
                }
                else{
                    return redirect('/buyerdashboard/manage-coupons')->with('error', 'You are not authorized');
                }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function update_coupon($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){

                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by == session('user_id')){
                    return view('seller.update-coupon')->with('userData', $userData)->with('coupon', $coupon);
                }
                else{
                    return redirect('/buyerdashboard/manage-coupons')->with('error', 'You are not authorized');
                }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function doupdate_coupon(Request $request, $id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){
                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by != session('user_id')){
                        return redirect('/buyerdashboard/manage-coupon')->with('error', 'you are not authorized');
                    }
                if($request->input('discount_option') == 1){
                    $validator = Validator::make($request->all(), [
                'title'=>'required|max:500|unique:create_coupon_codes,title,'.$id.',coupon_id',
                'code'=>'required|max:100|unique:create_coupon_codes,coupon_code,'.$id.',coupon_id',
                'start'=>'required|date|after:yesterday',
                'end'=>'required|date|after:start',
                'discount_option'=>'required|numeric|max:1|min:0',
                'discount'=>'required|numeric|min:0|max:100'
            ]);
                }
                else{
                    $validator = Validator::make($request->all(), [
                'title'=>'required|max:500|unique:create_coupon_codes,title,'.$id.',coupon_id',
                'code'=>'required|max:100|unique:create_coupon_codes,coupon_code,'.$id.',coupon_id',
                'start'=>'required|date|after:yesterday',
                'end'=>'required|date|after:start',
                'discount_option'=>'required|numeric|max:1|min:0',
                'discount'=>'required|numeric|min:0'
            ]);
                }
            if ($validator->fails()) {
             return redirect('/buyerdashboard/update-coupon/'.$id)->with('errors',$validator->errors());
            }
            else{
                if($request->input('discount_option') == 1){
                    create_coupon_code::where('coupon_id', $id)->update(['title'=>$request->input('title'), 'coupon_code'=>$request->input('code'), 'start_date'=>$request->input('start'), 'end_date'=>$request->input('end'), 'updated_by'=>session('user_id'), 'is_percentage'=>1, 'is_fixed'=>0]);
                }
                else{
                    create_coupon_code::where('coupon_id', $id)->update(['title'=>$request->input('title'), 'coupon_code'=>$request->input('code'), 'start_date'=>$request->input('start'), 'end_date'=>$request->input('end'), 'updated_by'=>session('user_id'), 'is_percentage'=>0, 'is_fixed'=>1]);
                }
                return redirect('/buyerdashboard/manage-coupons')->with('success', 'Coupon updated successfully');
            }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function manage_rules($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){

                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by == session('user_id')){
                    $rules = coupon_code_rules::select('coupon_code_rules.*', 'create_coupon_codes.title', 'create_coupon_codes.coupon_code')->leftjoin('create_coupon_codes', 'create_coupon_codes.coupon_id', '=', 'coupon_code_rules.coupon_id')->where('coupon_code_rules.coupon_id', $id)->get();
                    return view('seller.manage-rules')->with('userData', $userData)->with('rules', $rules)->with('id', $id);
                }
                else{
                    return redirect('/buyerdashboard/manage-coupons')->with('error', 'You are not authorized');
                }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function add_rules($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){

                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by == session('user_id')){
                    return view('seller.add-rules')->with('userData', $userData)->with('id', $id);
                }
                else{
                    return redirect('/buyerdashboard/manage-coupons')->with('error', 'You are not authorized');
                }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function doadd_rules(Request $request, $id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){
                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by != session('user_id')){
                        return redirect('/buyerdashboard/manage-coupon')->with('error', 'you are not authorized');
                    }

                $validator = Validator::make($request->all(), [
                'maxamount'=>'required|numeric|min:0',
                'minamount'=>'required|numeric|min:0|max:'.$request->input('maxamount').'',
                'id'=>'required|numeric|unique:coupon_code_rules,coupon_id',
            ]);

            if ($validator->fails()) {
             return redirect('/buyerdashboard/add-rule/'.$id)->with('errors',$validator->errors())->withInput();
            }
            else{
                $rule = new coupon_code_rules;
                $rule->coupon_id = $id;
                $rule->minimum_amount = $request->input('minamount');
                $rule->maximum_amount = $request->input('maxamount');
                $rule->created_by = session('user_id');
                $rule->updated_by = session('user_id');
                $rule->save();
                return redirect('/buyerdashboard/manage-rules/'.$id)->with('success', 'Rule added successfully');
            }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function delete_rules($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){

                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by == session('user_id')){
                    coupon_code_rules::where('coupon_id', $id)->delete();
                    return redirect('/buyerdashboard/manage-rules/'.$id)->with('success', 'Rule deleted successfully');
                }
                else{
                    return redirect('/buyerdashboard/manage-coupons')->with('error', 'You are not authorized');
                }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function update_rules($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){

                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by == session('user_id')){
                    $rules = coupon_code_rules::where('coupon_id', $id)->first();
                    return view('seller.update-rules')->with('userData', $userData)->with('rules', $rules);
                }
                else{
                    return redirect('/buyerdashboard/manage-coupons')->with('error', 'You are not authorized');
                }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function doupdate_rules(Request $request, $id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            if($userData->is_seller == 1){
                $coupon = create_coupon_code::where('coupon_id', $id)->first();
                if($coupon->created_by != session('user_id')){
                        return redirect('/buyerdashboard/manage-coupon')->with('error', 'you are not authorized');
                    }

                $validator = Validator::make($request->all(), [
                'maxamount'=>'required|numeric|min:0',
                'minamount'=>'required|numeric|min:0|max:'.$request->input('maxamount').'',
            ]);

            if ($validator->fails()) {
             return redirect('/buyerdashboard/add-rule/'.$id)->with('errors',$validator->errors())->withInput();
            }
            else{
                coupon_code_rules::where('coupon_id', $id)->update(['maximum_amount'=>$request->input('maxamount'), 'minimum_amount'=>$request->input('minamount'), 'updated_by'=> session('user_id')]);
                return redirect('/buyerdashboard/manage-rules/'.$id)->with('success', 'Rule updated successfully');
            }
            }
            else{
                return redirect('/buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function view_hunt_request(){
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $products = hunt_products::where('created_by', session('user_id'))->get();
            return view('buyerdashboard.hunt-request')->with('userData', $userData)->with('products', $products);
        }
        else{
            return redirect('login');
        }
    }

    public function do_view_hunt_request($id){
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $product = hunt_products::select('created_by')->where('hunt_id', $id)->first();
            if($product->created_by == session('user_id')){
                $products = hunt_seller::where('hunt_id', $id)->get();
                return view('buyerdashboard.view-hunt-request')->with('userData', $userData)->with('products', $products);
            }
            else{
                return redirect('buyerdashboard')->with('error', 'You are not uthorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function buyer_confirm_hunt($id){
        if(session('usertype') == 'buyer'){
            $hunt_id = hunt_seller::select('hunt_id')->where('product_id', $id)->first();
            $product = DB::select(DB::raw('select hunt_sellers.*, hunt_products.created_by as buyer_id from hunt_sellers left join hunt_products on hunt_sellers.hunt_id = hunt_products.hunt_id where hunt_products.created_by = '.session('user_id').' and hunt_sellers.product_id = '.$id));
            if(count($product) == 1){
                hunt_seller::where('product_id', $id)->update(['product_status'=>0, 'seller_confirm_status'=>0]);
                return redirect('buyerdashboard/view-hunt/'.$hunt_id->hunt_id)->with('Success', 'Request Confirmed. Waiting for buyers Confirmation');
            }
            else{
                return redirect('buyerdashboard/view-hunt-request')->with('error', 'nothing to confirm');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function view_confirm_hunt(){
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $products = hunt_seller::where('created_by', session('user_id'))->get();
            return view('buyerdashboard.view-confirm-hunt')->with('userData',$userData)->with('products',$products);
        }
        else{
            return redirect('login');
        }
    }

    public function seller_confirm_hunt($id){
        if(session('usertype') == 'buyer'){
            $hunt_id = hunt_seller::select('hunt_id')->where('product_id', $id)->first();
            $product = DB::select(DB::raw('select hunt_sellers.*, hunt_products.created_by as buyer_id from hunt_sellers left join hunt_products on hunt_sellers.hunt_id = hunt_products.hunt_id where hunt_sellers.created_by = '.session('user_id').' and hunt_sellers.product_id = '.$id));
            if(count($product) == 1){
                hunt_seller::where('product_id', $id)->update(['seller_confirm_status'=>1]);
                return redirect('buyerdashboard/view-confirm-hunt-request')->with('Success', 'Request Confirmed');
            }
            else{
                return redirect('buyerdashboard/view-confirm-hunt-request')->with('error', 'nothing to confirm');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function view_seller_hunt($id){
        if(session('usertype') == 'buyer'){
            $products = hunt_seller::where('product_id', $id)->first();
            if(count($products) == 0){
                return redirect('buyerdashboard')->with('error', 'You are not authorized');
            }
            $userData = User::where('user_id', session('user_id'))->first();
            $product = hunt_products::select('created_by')->where('hunt_id', $products->hunt_id)->first();
            if($product->created_by == session('user_id')){

                return view('buyerdashboard.seller-hunt-detail')->with('userData', $userData)->with('products', $products);
            }
            else{
                return redirect('buyerdashboard')->with('error', 'You are not authorized');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function view_buyer_swap($id){
        session()->regenerate();
        if(session('usertype') == 'buyer'){
            $userData = User::where('user_id', session('user_id'))->first();
            $swap_request = DB::select(DB::raw('select swap_items.*, products.product_name as old_product_name, products.product_id as old_product_id from swap_items left join products on products.product_id = swap_items.for_product_id where swap_items.seller_id = '.session('user_id')));
            if(count($swap_request) == 0){
                return redirect('buyerdashboard')->with('error', 'You are not authorized');
            }
            $products = swap_items::where('swap_id', $id)->first();
            return view('buyerdashboard.view_swap_buyer')->with('userData', $userData)->with('products', $products);
        }
        else{
            return redirect('login');
        }
    }

    public function add_attribute_group(){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          return view('buyerdashboard.add_attribute_group')->with('userData', $userData);
      }
      else{
          return redirect('login');
      }
    }

    public function do_add_attribute_group(Request $request){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $validator = Validator::make($request->all(), [
            'gname'=>'required|min:0|max:100',
          ]);
          if($validator->fails()){
            return redirect('buyerdashboard/add-attribute-groups')->with([
              'errors'=>$validator->errors(),
            ])->withInput();
          }
          else{
            DB::table('attribute_groups')->insert([
              'seller_id'=>session('user_id'),
              'attribute_group_name'=>$request->input('gname'),
              'parent_id'=>0,
              'created_at'=>date('Y-m-d H:i:s'),
            ]);
            $last_id = DB::getPdo()->lastInsertId();
            if($request->input('method_type') == 'ajax'){
              echo $last_id;
            }
            else{
              return redirect('buyerdashboard/manage-product-attributes')->with([
                'success'=>'Attribute Group Added Successfully',
              ]);
            }
          }
      }
      else{
          return redirect('login');
      }
    }

    public function add_attributes($id){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $attribute_group = DB::table('attribute_groups')->where([
            'id'=>$id
          ])->first();
          if($attribute_group->seller_id != session('user_id') || $attribute_group->parent_id != 0){
            return redirect('buyerdashboard/manage-product-attributes')->with('error','An unknown error occurred, Please try again');
          }
          else{
            return view('buyerdashboard.add_attributes')->with([
                'userData'=>$userData,
                'attribute_group'=>$attribute_group
              ]);
          }
      }
      else{
          return redirect('login');
      }
    }

    public function do_add_attributes($id, Request $request){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $attribute_group = DB::table('attribute_groups')->where([
            'id'=>$id
          ])->first();
          if($attribute_group->seller_id != session('user_id') || $attribute_group->parent_id != 0 || $id != $request->input('group_name')){
            return redirect('buyerdashboard/manage-product-attributes')->with('error','An unknown error occurred, Please try again');
          }
          else{
            $total = $request->input('att_num');
            for($i=0; $i<$total; $i++){
              DB::table('attribute_groups')->insert([
                'seller_id'=>session('user_id'),
                'parent_id'=>$id,
                'attribute_name'=>$request->input('attribute_name'.$i),
                'type'=>$request->input('input_type'.$i),
                'value'=>$request->input('attribute_values'.$i),
                'created_at'=>date('Y-m-d H:i:s')
              ]);
            }
            return redirect('buyerdashboard/manage-product-attributes')->with('success','Attributes added successfully');
          }
      }
      else{
          return redirect('login');
      }
    }

    public function get_attributes(Request $request){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $attribute_group = DB::table('attribute_groups')->where([
            'id'=>$request->input('group_id')
          ])->first();

          if($attribute_group->seller_id != session('user_id') || $attribute_group->parent_id != 0){
            echo 'An unknown error occurred, Please try again';
          }
          else{
            $attributes = DB::table('attribute_groups')->where([
              'parent_id'=>$request->input('group_id'),
              'seller_id'=>session('user_id')
            ])->get();
          }
          if(count($attributes) > 0){
            $html = '<a href="#/" style="float:right; color:blue;" onClick="addMoreAttribute()">Add More</a><div attribute_div="0">';
            foreach($attributes as $item){
              $html.= '<div class="form-group">
                        <label class="control-label" for="attribute_name">'.$item->attribute_name.'</label>"';
              if($item->type == 'Text Box'){
                $html.= '<input type="text" attribute="true" class="form-control" name="'.$item->id.'">';
              }
              if($item->type == 'Text Area'){
                $html.= '<textarea class="form-control ckeditor" attribute="true" name="'.$item->id.'"></textarea>';
              }
              if($item->type == 'Dropdown'){
                $html.= '<select class="form-control" attribute="true" name="'.$item->id.'">';
                foreach(explode(',',$item->value) as $item1){
                  $html.='<option value="'.$item1.'">'.$item1.'</option>';
                }
                $html.= '</select>';
              }
              if($item->type == 'Option Button'){
                $html.= "<br>";
                foreach(explode(',',$item->value) as $item1){
                  $html.='<input type="radio" attribute="true" value="'.$item1.'" name="'.$item->id.'">'.$item1;
                }
              }
              $html.= '</div>';
            }
            $html.='<div class="form-group">
                      <label class="control-label" for="attribute_values">Quantity</label>
                      <input type="number" attribute="true" class="form-control" name="quantity" value="" placeholder="Quantity" id="quantity"/>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="attribute_values">Display Price</label>
                      <input type="number" class="form-control display_price" attribute="true" name="display_price" value="" placeholder="Price"/>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="attribute_values">Selling Price</label>
                      <input type="number" attribute="true" class="form-control price" name="selling_price" value="" placeholder="Price"/>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="attribute_values">Discount Type</label><br>
                      <label class="radio-inline">
                        <input type="radio" attribute="true" class="discount" name="discount_radio" value="percentage"/>Percentage
                      </label>
                      <label class="radio-inline">
                        <input type="radio" attribute="true" class="discount" name="discount_radio" value="dollar"/>USD
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="attribute_values">Discount Value</label>
                      <input type="number" attribute="true" class="form-control discount_value" name="discount_value" value="" placeholder="Discount Value"/>
                    </div>
                    <div class="form-group">
                      <label class="control-label" for="attribute_values">Final Price</label>
                      <input type="number" attribute="true" class="form-control after_discount" name="after_discount" value="" placeholder="Price" disabled/>
                    </div>';
            echo $html;
          }
          else{
            echo 'No attributes found for this group.';
          }
      }
      else{
          return redirect('login');
      }
    }

    public function manage_attributes($id){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $attribute_group = DB::table('attribute_groups')->where([
            'id'=>$id
          ])->first();
          $attributes = DB::table('attribute_groups')->where([
            'seller_id'=>session('user_id'),
            'parent_id'=>$id
          ])->get();
          if($attribute_group->seller_id != session('user_id') || $attribute_group->parent_id != 0){
            return redirect('buyerdashboard/manage-product-attributes')->with('error','An unknown error occurred, Please try again');
          }
          else{
            return view('buyerdashboard.manage_attributes')->with([
                'userData'=>$userData,
                'attributes'=>$attributes
              ]);
          }
      }
      else{
          return redirect('login');
      }
    }

    public function delete_attributes($id){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $attribute_group = DB::table('attribute_groups')->where([
            'id'=>$id
          ])->first();
          $attributes = DB::table('attribute_groups')->where([
            'seller_id'=>session('user_id'),
            'parent_id'=>$attribute_group->parent_id
          ])->get();
          if($attribute_group->seller_id != session('user_id') || $attribute_group->parent_id == 0){
            return redirect('buyerdashboard/manage-attributes/'.$attribute_group->parent_id)->with([
                'userData'=>$userData,
                'attributes'=>$attributes,
                'error'=>'An unknown error occurred, Please try again'
              ]);
          }
          else{
            DB::table('attribute_groups')->where('id',$id)->delete();
            DB::table('product_attributes')->where('attribute_id',$id)->delete();
            return redirect('buyerdashboard/manage-attributes/'.$attribute_group->parent_id)->with([
                'userData'=>$userData,
                'attributes'=>$attributes,
                'success'=>'Attribute successfully deleted'
              ]);
          }
      }
      else{
          return redirect('login');
      }
    }

    public function change_attribute($id){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $attribute_group = DB::table('attribute_groups')->where([
            'id'=>$id
          ])->first();
          if($attribute_group->seller_id != session('user_id') || $attribute_group->parent_id == 0){
            return redirect('buyerdashboard/manage-product-attributes')->with('error','An unknown error occurred, Please try again');
          }
          else{
            return view('buyerdashboard.change-attribute')->with([
                'userData'=>$userData,
                'attributes'=>$attribute_group
              ]);
          }
      }
      else{
          return redirect('login');
      }
    }

    public function do_change_attribute(Request $request, $id){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $attribute_group = DB::table('attribute_groups')->where([
            'id'=>$id
          ])->first();
          if($attribute_group->seller_id != session('user_id') || $attribute_group->parent_id == 0){
            return redirect('buyerdashboard/manage-attributes/'.$attribute_group->parent_id)->with('error','An unknown error occurred, Please try again');
          }
          else{
            DB::table('attribute_groups')->where('id',$id)->update([
              'attribute_name'=>$request->input('attribute_name'),
              'value'=>$request->input('attribute_values'),
              'type'=>$request->input('input_type'),
              'updated_at'=>date('Y-m-d H:i:s')
            ]);
            return redirect('buyerdashboard/manage-attributes/'.$attribute_group->parent_id)->with('success','Product attribute changed successfully');
          }
      }
      else{
          return redirect('login');
      }
    }

    public function swap_transactions(){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
            $swap_transactions = DB::select(DB::raw('select paypal_swap_transactions.*, a.first_name as seller_name, b.first_name as buyer_name, swap_items.product_name as seller_product, products.product_name as buyer_product from paypal_swap_transactions left join users a on a.user_id = paypal_swap_transactions.seller_id left join users b on b.user_id = paypal_swap_transactions.buyer_id left join swap_items on swap_items.swap_id = paypal_swap_transactions.seller_product_id left join products on products.product_id = paypal_swap_transactions.buyer_product_id where paypal_swap_transactions.seller_id = '.session('user_id').' or paypal_swap_transactions.buyer_id = '.session('user_id')));
            return view('buyerdashboard.swap-leads')->with('swap_transactions',$swap_transactions)->with('userData',$userData);
          }
      else{
          return redirect('login');
      }
    }

    public function hunt_transactions(){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
            $hunt_transactions = DB::select(DB::raw('select paypal_hunt_transactions.*, a.first_name as seller_name, b.first_name as buyer_name, hunt_products.product_name as for_product, hunt_sellers.product_name as product_name from paypal_hunt_transactions left join users a on a.user_id = paypal_hunt_transactions.seller_id left join users b on b.user_id = paypal_hunt_transactions.buyer_id left join hunt_products on hunt_products.hunt_id = paypal_hunt_transactions.for_product_id left join hunt_sellers on hunt_sellers.product_id = paypal_hunt_transactions.buyer_product_id where buyer_id='.session('user_id')));
            return view('buyerdashboard.hunt-leads')->with('hunt_transactions',$hunt_transactions)->with('userData',$userData);
          }
      else{
          return redirect('login');
      }
    }

    public function manage_shipping(){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $countries = DB::table('countries')->get();
            $shipping_array = DB::table('seller_shippings')->where(['seller_id'=>session('user_id')])->orderBy('id','desc')->get();
            return view('buyerdashboard.manage-shipping')->with('userData',$userData)->with('shipping_array',$shipping_array)->with('countries',$countries);
          }
      else{
          return redirect('login');
      }
    }

    public function do_manage_shipping(Request $request){
      session()->regenerate();
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', session('user_id'))->first();
          $result = DB::table('seller_shippings')->where([
            'seller_id'=>session('user_id'),
            'from_country'=>$request->input('from'),
            'to_country'=>$request->input('to')
          ])->get();
          if(count($result)>0){
            DB::table('seller_shippings')->where([
              'seller_id'=>session('user_id'),
              'from_country'=>$request->input('from'),
              'to_country'=>$request->input('to')
            ])->update([
              'cost'=>$request->input('cost'),
              'updated_at'=>date('Y-m-d H:i:s')
            ]);
            return redirect('buyerdashboard/manage-shipping')->with('success','Shipping details successfully updated');
          }
          else{
            DB::table('seller_shippings')->insert([
              'seller_id'=>session('user_id'),
              'from_country'=>$request->input('from'),
              'to_country'=>$request->input('to'),
              'cost'=>$request->input('cost'),
              'created_at'=>date('Y-m-d H:i:s')
            ]);
            return redirect('buyerdashboard/manage-shipping')->with('success','Shipping details successfully added');
          }
      }
      else{
          return redirect('login');
      }
    }

    public function getToCountries(Request $request){
      $countries = DB::table('seller_shippings')->where([
        'seller_id'=>session('user_id'),
        'from_country'=>$request->input('from')
      ])->get();
      $html = "";
      foreach($countries as $item){
        $html.='<option value="'.$item->id.'">'.$item->to_country.'</option>';
      }
      echo $html;
    }
}
