<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\admin;

use App\Categories;

use App\attributes;

use App\brands;

use Carbon\Carbon;

use App\selltype;

use File;

use Illuminate\Support\Facades\Validator;

use App\auction_categories;

use Session;

use Hash;

use App\create_coupon_code;

use App\hunt_commission;

use App\paypal_transactions;

use App\Products;

use DB;

class AdminController extends Controller
{
    public function adminlogin(){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		return redirect('/admindashboard');
    	}
    	else{
    		return view('admin.adminlogin');
    	}
    }

    public function doadminlogin(Request $request){
    	$admin = admin::where('admin_email',$request->input('email'))->get();
    	if(count($admin) == 1){
    		foreach($admin as $admins){
    			$admin_email = $admins->admin_email;
    			$admin_password = $admins->admin_password;
    			$admin_id = $admins->admin_id;
    		}
    		if($admin_email == $request->input('email') && (Hash::check($request->password, $admin_password))){
    			session()->regenerate();
    			session(['usertype' => 'admin',
                        'admin_id' => $admin_id,
                    ]);
    			return redirect('/admindashboard')->with('success','Successfully logged in');
    		}
    		else{
    			return redirect('/admin')->with('error','invalid email or password');
    		}
    	}
    	else{
    		return redirect('/admin')->with('error','email does not exist');
    	}
    }

    public function admindashboard(){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		return view('admin.admindashboard')->with('adminData',$adminData);
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function managecategories(){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		$categories = Categories::where('parent_id', '0')->get();
    		return view('admin.managecategories')->with('adminData',$adminData)->with('categories',$categories);
    	}
    }

    public function viewsubcategories(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		$subcategories = Categories::where('parent_id', $request->input('id'))->get();
    		return view('admin.viewsubcategories')->with('adminData',$adminData)->with('subcategories',$subcategories)->with('category_id',$request->input('id'));
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function managebrands(){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		$brands = brands::get();
    		return view('admin.managebrands')->with('adminData',$adminData)->with('brands',$brands);
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function auctioncategories(){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		$auctioncategories = auction_categories::get();
    		return view('admin.auctioncategories')->with('adminData',$adminData)->with('auctioncategories',$auctioncategories);
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function addproductcategory(){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		return view('admin.addproductcategory')->with('adminData',$adminData);
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function doaddproductcategory(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$validator = Validator::make($request->all(), [
                'name'=>'required|max:50|regex:/(^[A-Za-z ]+$)+/|unique:categories,category_name',
                'status'=>'required|numeric|max:1|min:0',
                'image'=>'required|mimes:jpeg,bmp,png,jpg',
            ]);

        if ($validator->fails()) {
             return redirect('/admindashboard/addproductcategory')->with('errors',$validator->errors());
        }
        else{
        	$index = Categories::get();
        	if(count($index) == 0){
        		$index_value = 1;
        	}
        	else{
        		$index_value = Categories::where('index_value')->max('index_value');
        		$index_value = $index_value + 1;
        	}
        	$destinationPath = base_path() . '/public/images/product_category/';
    		$current_time = Carbon::now();
    		$extension = $request->file('image')->getClientOriginalExtension(); 
    		$date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second;
      		$fileName = $date.'.'.$extension;
      		$request->file('image')->move($destinationPath, $fileName);
        	$category = new Categories;
        	$category->category_name = $request->input('name');
        	$category->status_value = $request->input('status');
        	$category->category_image = $fileName;
        	$category->created_by = session('admin_id');
        	$category->updated_by = session('admin_id');
        	$category->parent_id = 0;
        	$category->index_value = $index_value;
        	$category->save();
        	return redirect('/admindashboard/managecategories')->with('success','Category Successfully added');
        }

    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function editproductcategory(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		if(!empty($request->input('id'))){
    			$categories = Categories::where('category_id',$request->input('id'))->first();
    			return view('admin.editproductcategory')->with('adminData',$adminData)->with('categories',$categories);
    		}
    		else{
    			return redirect('/admindashboard/managecategories');
    		}
    		
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function doeditproductcategory(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$validator = Validator::make($request->all(), [
                'name'=>'required|max:50|regex:/(^[A-Za-z ]+$)+/|unique:categories,category_name',
                'status'=>'required|numeric|max:1|min:0',
                'image'=>'mimes:jpeg,bmp,png,jpg',
            ]);
            if ($validator->fails()) {
             return redirect('/admindashboard/editproductcategory')->with('errors',$validator->errors());
        }
        else{
        	$categories = Categories::where('category_id',$request->input('category_id'))->first();

        	if($request->file('image')){
        	$destinationPath = base_path() . '/public/images/product_category/';
    		$current_time = Carbon::now();
    		$extension = $request->file('image')->getClientOriginalExtension(); 
    		$date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second;
      		$fileName = $date.'.'.$extension;
      		$request->file('image')->move($destinationPath, $fileName);
      	}
      	else{
      	$fileName = $categories->category_image;
      }
        	Categories::where('category_id',$request->input('category_id'))->update([
        			'category_name' => $request->input('name'),
        			'status_value' => $request->input('status'),
        			'category_image' => $fileName,
        			'updated_by' => session('admin_id'),
        		]);
        	return redirect('/admindashboard/managecategories')->with('success','Category Successfully updated');
        }
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function deleteproductcategory(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		Categories::where('category_id',$request->input('id'))->delete();
    		Categories::where('parent_id',$request->input('id'))->delete();
    		return redirect('/admindashboard/managecategories')->with('success','Category Successfully deleted');
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function addbrand(){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		return view('admin.addbrand')->with('adminData',$adminData);
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function doaddbrand(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$validator = Validator::make($request->all(), [
                'name'=>'required|max:50|unique:brands,brand_name',
            ]);
            if ($validator->fails()) {
             return redirect('/admindashboard/addbrand')->with('errors',$validator->errors());
        }
        else{
        	$brands = new brands;
        	$brands->brand_name = $request->input('name');
        	$brands->created_by = session('admin_id');
        	$brands->updated_by = session('admin_id');
        	$brands->save();
        	return redirect('/admindashboard/managebrands')->with('success','Brand Successfully added');
        }
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function editbrands(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$adminData = admin::where('admin_id',session('admin_id'))->first();
    		$brands = brands::where('brand_id',$request->input('id'))->first();
    		return view('/admin.editbrands')->with('adminData',$adminData)->with('brands',$brands);
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function doeditbrands(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		$validator = Validator::make($request->all(), [
                'name'=>'required|max:50|unique:brands,brand_name',
            ]);
            if ($validator->fails()) {
             return redirect('/admindashboard/editbrands')->with('errors',$validator->errors());
        }
        else{
        	brands::where('brand_id',$request->input('brand_id'))->update([
        			'brand_name' => $request->input('name'),
        			'updated_by' => session('admin_id'),
        		]);

        	return redirect('/admindashboard/managebrands')->with('success','Brand Successfully updated');
        }
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function deletebrand(Request $request){
    	session()->regenerate();
    	if(session('usertype') == 'admin'){
    		brands::where('brand_id', $request->input('id'))->delete();
    		return redirect('/admindashboard/managebrands')->with('success','Brand Successfully deleted');
    	}
    	else{
    		return redirect('/admin');
    	}
    }

    public function addsubcategory(Request $request){
    	session()->regenerate();
   		if(session('usertype') == 'admin'){
   			$adminData = admin::where('admin_id',session('admin_id'))->first();
			$attributes = Attributes::get();

   			return view('admin.addsubcategory')->with('adminData',$adminData)->with('parent_id',$request->input('parent_id'))->with('attributes',$attributes);
   		}
   		else{
   			return redirect('/admin');
   		}
    }

    public function doaddsubcategory(Request $request){
    	session()->regenerate();
   		if(session('usertype') == 'admin'){
   			$validator = Validator::make($request->all(), [
                'name'=>'required|max:50|regex:/(^[A-Za-z ]+$)+/|unique:categories,category_name',
                'status'=>'required|numeric|max:1|min:0',
                'parent_id'=>'required|numeric|exists:categories,category_id'
            ]);

        if ($validator->fails()) {
             return redirect('/admindashboard/addsubcategory')->with('errors',$validator->errors());
        }
        else{
        	$index = Categories::get();
        	if(count($index) == 0){
        		$index_value = 1;
        	}
        	else{
        		$index_value = Categories::where('index_value')->max('index_value');
        		$index_value = $index_value + 1;
        	}
			$attributes = implode(',',$request->input('attributes'));
        	$category = new Categories;
        	$category->category_name = $request->input('name');
        	$category->status_value = $request->input('status');
        	$category->created_by = session('admin_id');
        	$category->updated_by = session('admin_id');
        	$category->parent_id = $request->input('parent_id');
        	$category->index_value = $index_value;
			$category->attributes = $attributes;
        	$category->save();
        	return redirect('/admindashboard/viewsubcategories?id='.$request->input('parent_id'))->with('success','Category Successfully added');
        }
   		}
   		else{
   			return redirect('/admin');
   		}
    }

    public function deletesubcategory(Request $request){
    	session()->regenerate();
   		if(session('usertype') == 'admin'){
   			Categories::where('category_id',$request->input('id'))->delete();
   			return redirect('/admindashboard/viewsubcategories?id='.$request->input('parent_id'))->with('success','Category Successfully deleted');
   		}
   		else{
   			return redirect('/admin');
   		}
    }

    public function editsubcategory(Request $request){
    	session()->regenerate();
   		if(session('usertype') == 'admin'){
   			$adminData = admin::where('admin_id',session('admin_id'))->first();
    		if(!empty($request->input('id'))){
    			$subcategories = Categories::where('category_id',$request->input('id'))->first();
				$attributes = Attributes::get();
				$selected_attributes = explode(',',$subcategories->attributes);
    			return view('admin.editsubcategory')->with('adminData',$adminData)->with('subcategories',$subcategories)->with('attributes',$attributes)->with('selected_attributes',$selected_attributes);
    		}
    		else{
    			return redirect('/admindashboard/managecategories');
    		}
   		}
   		else{
   			return redirect('/admin');
   		}
    }

    public function doeditsubcategory(Request $request){
    	session()->regenerate();
   		if(session('usertype') == 'admin'){
   			$validator = Validator::make($request->all(), [
                'name'=>'required|max:50|regex:/(^[A-Za-z ]+$)+/|unique:categories,category_name,'.$request->input('category_id').',category_id',
                'status'=>'required|numeric|max:1|min:0',
            ]);
            if ($validator->fails()) {
             return redirect('/admindashboard/editsubcategory?id='.$request->input('category_id'))->with('errors',$validator->errors());
        }
        else{
        	$subcategories = Categories::where('category_id',$request->input('category_id'))->first();
			$attributes = implode(',',$request->input('attributes'));
        	Categories::where('category_id',$request->input('category_id'))->update([
        			'category_name' => $request->input('name'),
        			'status_value' => $request->input('status'),
        			'updated_by' => session('admin_id'),
					'attributes'=>$attributes,
        		]);
        	return redirect('/admindashboard/viewsubcategories?id='.$request->input('parent_id'))->with('success','Subcategory Successfully updated');
        }
   		}
   		else{
   			return redirect('/admin');
   		}
    }

    public function manage_coupons(){
        session()->regenerate();
        if(session('usertype') == 'admin'){
            $adminData = admin::where('admin_id',session('admin_id'))->first();
            $seller_coupons = create_coupon_code::where('role_id', 3)->get();
            $admin_coupons = create_coupon_code::where('role_id', 1)->get();
            return view('admin.manage-coupons')->with('adminData',$adminData)->with('scoupons', $seller_coupons)->with('acoupons', $admin_coupons);
        }
        else{
            return redirect('/admin');
        }
    }

    public function hunting_commission(){
        session()->regenerate();
        if(session('usertype') == 'admin'){
            $adminData = admin::where('admin_id',session('admin_id'))->first();
            $commission = hunt_commission::get();
            return view('admin.hunting-commission')->with('adminData', $adminData)->with('commission',$commission);
        }
        else{
            return redirect('/admin');
        }
    }

    public function view_update_commission($id){
        session()->regenerate();
        if(session('usertype') == 'admin'){
            $adminData = admin::where('admin_id',session('admin_id'))->first();
            $commission = hunt_commission::where('commission_id', $id)->first();
            return view('admin.update-hunting-commission')->with('adminData', $adminData)->with('commission',$commission);
    }
    else{
        return redirect('/admin');
    }
}

public function do_view_update_commission($id, Request $request){
        session()->regenerate();
        if(session('usertype') == 'admin'){
            $validator = Validator::make($request->all(), [
                'percentage'=>'required|max:100|min:0|numeric',
                'fixed'=>'required|min:0|numeric',
                'maximum'=>'required|min:0|numeric',
            ]);
            if ($validator->fails()) {
             return redirect('/admindashboard/update-hunt-commission/'.$id)->with('errors',$validator->errors());
        }
        else{
            hunt_commission::where('commission_id', $id)->update(['fixed'=>$request->input('fixed'), 'maximum'=>$request->input('maximum'), 'percentage'=>$request->input('percentage')]);
            return redirect('admindashboard/hunting-commission')->with('success', 'successfully updated');
        }
    }
    else{
        return redirect('/admin');
    }
}
public function manage_reports(){
        session()->regenerate();
        if(session('usertype') == 'admin'){
            $adminData = admin::where('admin_id',session('admin_id'))->first();
            $transactions = DB::select(DB::raw('SELECT a.*,b.first_name as buyer_name, c.first_name as seller_name, products.product_name FROM `paypal_transactions` a left join users b on a.buyer_id=b.user_id left join users c on a.seller_id=c.user_id left join products on products.product_id = a.product_id'));

            $swap_transactions = DB::select(DB::raw('select paypal_swap_transactions.*, a.first_name as seller_name, b.first_name as buyer_name, swap_items.product_name as seller_product, products.product_name as buyer_product from paypal_swap_transactions left join users a on a.user_id = paypal_swap_transactions.seller_id left join users b on b.user_id = paypal_swap_transactions.buyer_id left join swap_items on swap_items.swap_id = paypal_swap_transactions.seller_product_id left join products on products.product_id = paypal_swap_transactions.buyer_product_id'));

            $hunt_transactions = DB::select(DB::raw('select paypal_hunt_transactions.*, a.first_name as seller_name, b.first_name as buyer_name, hunt_products.product_name as for_product, hunt_sellers.product_name as product_name from paypal_hunt_transactions left join users a on a.user_id = paypal_hunt_transactions.seller_id left join users b on b.user_id = paypal_hunt_transactions.buyer_id left join hunt_products on hunt_products.hunt_id = paypal_hunt_transactions.for_product_id left join hunt_sellers on hunt_sellers.product_id = paypal_hunt_transactions.buyer_product_id'));


            return view('admin.manage-reports')->with('adminData', $adminData)->with('transactions', $transactions)->with('swap_transactions', $swap_transactions)->with('hunt_transactions', $hunt_transactions);
    }
    else{
        return redirect('/admin');
    }
}

public function manage_products(){
	session()->regenerate();
        if(session('usertype') == 'admin'){
            $adminData = admin::where('admin_id',session('admin_id'))->first();
            $selling_products = DB::select(DB::raw('select a.*, b.category_name as category_name, c.category_name as subcategory_name, concat(d.first_name,concat(" ",d.last_name)) as seller_name from products a left join categories b on a.product_category = b.category_id left join categories c on a.product_subcategory = c.category_id left join users d on a.seller_id = d.user_id where a.sell_type_id = 1'));
			
            return view('admin.manage-products')->with('adminData', $adminData)->with('selling_products', $selling_products);
    }
    else{
        return redirect('/admin');
    }
}

public function update_products($id){
	$adminData = admin::where('admin_id',session('admin_id'))->first();
	$product = Products::where('product_id',$id)->first();
	$category = Categories::where('parent_id','0')->get();
    $selltype = selltype::get();
	$subcategory = Categories::where('category_id',$product->product_subcategory)->first(['category_name']);
	return view('admin.update-product')->with('adminData', $adminData)->with('categories',$category)->with('selltype',$selltype)->with('product',$product)->with('subcategory',$subcategory);
}

public function do_update_products(Request $request, $id){
	$validator = Validator::make($request->all(), [
		'ptitle'=>'required|max:100',
		'category'=>'required|max:50|exists:categories,category_id',
		'scategory'=>'required|max:50|exists:categories,category_id',
		'description'=>'required',
		'stype' => 'required|max:50|exists:selltypes,sell_type_id',
		'keywords' => 'required|max:500',
		'image' => 'dimensions:min_width=500,min_height=500|mimes:jpeg,bmp,png,jpg',
		'image1' => 'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
		'image2' => 'mimes:jpeg,bmp,png|dimensions:min_width=500,min_height=500',
		'image3' => 'mimes:jpeg,bmp,png|dimensions:min_width=500,min_height=500',
		'actualprice'=>'required|numeric|min:0',
		'sellprice'=>'required|numeric|min:0',
		'discount'=>'required|numeric|min:0|max:100',
		'afterdiscount'=>'required|numeric|min:0',
		'status'=>'required|numeric|min:0|max:1'
	]);
	
	if ($validator->fails()) {
             return redirect('/admindashboard/update-product/'.$id)->withInput()->with('errors',$validator->errors());
        }
        else{
      if($request->file('image')){
		  $destinationPath = base_path() . '/public/images/product_master/';
			$current_time = Carbon::now();
			$extension = $request->file('image')->getClientOriginalExtension(); 
			$date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second;
			  $fileName = $date.'.'.$extension;
			  $request->file('image')->move($destinationPath, $fileName);
			  session(['product_images' => $fileName]);
			  Products::where('product_id',$id)->update(['product_images'=>session('product_images')]);
	  }
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
          session(['product_name' => $request->input('ptitle'),
              'product_category' => $request->input('category'),
              'product_subcategory' => $request->input('scategory'),
              'product_description' => $request->input('description'),
              'sell_type_id' => $request->input('stype'),
              'keywords' => $request->input('keywords'),
            ]);
          if($request->file('image1')){
                    session(['image1' => $fileName1]);
                }
                if($request->file('image2')){
                    session(['image2' => $fileName2]);
                }
                if($request->file('image3')){
                    session(['image3' => $fileName3]);
                }
			session(['actual_price' => $request->input('actualprice'), 'selling_price' => $request->input('sellprice'), 'discount' => $request->input('discount'), 'discount_price' => $request->input('afterdiscount')]);
			  
			  Products::where('product_id',$id)->update([
															'product_name' => session('product_name'),
															'product_price' => session('actual_price'),
															'display_price' => session('selling_price'),
															'product_description' => session('product_description'),
															'product_category' => session('product_category'),
															'product_subcategory' => session('product_subcategory'),
															'keywords' => session('keywords'),
															'sell_type_id' => session('sell_type_id'),
															'seller_discount' => session('discount'),
															'price_after_discount' => session('discount_price'),
															'status_value' => $request->input('status')
														]);
			  if(Session::has('image1')){
				Products::where('product_id',$id)->update(['product_image_1'=>session('image1')]);
			  }
			  if(Session::has('image2')){
				Products::where('product_id',$id)->update(['product_image_2'=>session('image2')]);
			  }
			  if(Session::has('image3')){
				Products::where('product_id',$id)->update(['product_image_3'=>session('image3')]);
			  }
	  
          return redirect('/admindashboard/update-product/'.$id)->with('success','Product Details Updated');
        }
}
}
