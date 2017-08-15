<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Products;
use App\hunt_products;
use App\attributes;
use App\Cart;
use DB;
use URL;
use App\Categories;
use App\selltype;
use App\product_attributes;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\hunt_seller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Validator;

class ProductController extends Controller
{

  public function featured(){
    return Products::where('sell_type_id', 1)->orderBy('price_after_discount', 'desc')->take(3)->get();
  }

    public function daily(){
    return Products::where('sell_type_id', 1)->orderBy('created_at', 'desc')->take(3)->get();
  }

   public function sellstepone(Request $request){
   	if(session('usertype') == 'buyer'){
        $user = User::where('user_id', Session('user_id'))->first();
        $validator = Validator::make($request->all(), [
                'ptitle'=>'required|max:100',
                'category'=>'required|max:50|exists:categories,category_id',
                'scategory'=>'required|max:50|exists:categories,category_id',
                'description'=>'required',
                'stype' => 'required|max:50|exists:selltypes,sell_type_id',
                'keywords' => 'required|max:500',
                'image' => 'required|dimensions:min_width=500,min_height=500|mimes:jpeg,bmp,png,jpg',
                'image1' => 'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
                'image2' => 'mimes:jpeg,bmp,png|dimensions:min_width=500,min_height=500',
                'image3' => 'mimes:jpeg,bmp,png|dimensions:min_width=500,min_height=500',
                'location'=>'required|max:100',
                'status'=>'required|max:100',
            ]);
        if ($validator->fails()) {
             return redirect('/buyerdashboard/sellitem')->withInput()->with('errors',$validator->errors());
        }
        else{

    $destinationPath = base_path() . '/public/images/product_master/';
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
          session(['product_name' => $request->input('ptitle'),
              'product_category' => $request->input('category'),
              'product_subcategory' => $request->input('scategory'),
              'product_description' => $request->input('description'),
              'sell_type_id' => $request->input('stype'),
              'keywords' => $request->input('keywords'),
              'product_images' => $fileName,
              'product_status'=>$request->input('status'),
              'quantity'=>$request->input('quantity'),
              'location'=>$request->input('location'),
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
          return redirect('/buyerdashboard/sellsteptwo')->with('success','Details saved!! Please continue...');
        }

    }
    else{
      return redirect('login');
    }
   }

   public function sellsteptwo(){
    if(session('usertype') == 'buyer'){
      if(!empty(session('product_name'))){
        $user = User::where('user_id', Session('user_id'))->first();
        $attribute_groups = DB::table('attribute_groups')->where([
          'seller_id'=>session('user_id'),
          'parent_id'=>0
        ])->get();
        return view('sellsteptwo')->with('userData',$user)->with('attribute_groups',$attribute_groups);
      }
      else{
        return redirect('/buyerdashboard/sellitem')->with('error','please fill the initial details first');
      }
    }
    else{
      return redirect('login');
    }
   }

   public function dosellsteptwo(Request $request){
    if(session('usertype') == 'buyer'){
		  $attribute_values = array();
		  $values = json_decode($request->input('form'),true);
      // echo "<pre>";
      // print_r($values);
      // exit;
		  for($i=0; $i<count($values); $i++){
        for($k=0; $k<count($values[$i]); $k++){
          if(ISSET($values[$i][$k]['name'])){
            $attribute_values[$i][$k]['attribute_id'] = $values[$i][$k]['name'];
            $attribute_values[$i][$k]['attribute_value'] = $values[$i][$k]['value'];
            $attribute_values[$i][$k]['group_id'] = $values[$i][$k]['group_id'];
            $attribute_values[$i][$k]['sell_type'] = session('sell_type_id');
          }
        }
      }
      // echo "<pre>";
      // print_r($attribute_values);
      // exit;
		  session::put('attributes',$attribute_values);
		  session::put('attributes_html',$request->input('content'));
          //return redirect('/buyerdashboard/sellstepthree')->with('success','Details saved!! Please continue...');
          echo 'success';

    }
    else{
      return redirect('/login');
    }
   }

   public function sellstepthree(){
    if(session('usertype') == 'buyer'){
      if(!empty(session('attributes'))){
        $from_countries = DB::table('seller_shippings')->groupBy('from_country')->get();
        $user = User::where('user_id', Session('user_id'))->first();
        return view('sellstepthree')->with('userData',$user)->with('countries',$from_countries);
      }
      else{
        return redirect('/buyerdashboard/sellsteptwo')->with('error','please fill the initial details first');
      }
    }
    else{
      return redirect('/login');
    }
   }

   public function dosellstepthree(Request $request){
    if(session('usertype') == 'buyer'){
      // echo "<pre>";
      // print_r($request->all());
      // exit;
      $validator = Validator::make($request->all(), [
                'weight'=>'required|numeric|min:0',
                'from'=>'required',
                'to'=>'required',
            ]);
        if ($validator->fails()) {
             return redirect('/buyerdashboard/sellstepthree')->with('errors',$validator->errors());
        }
        else{
          session::put('weight',$request->input('weight'));
          session::put('shipping_ids',$request->input('to'));
          return redirect('/buyerdashboard/sellpreview')->with('success','Details saved!! Please continue...');
        }
    }
    else{
      return redirect('/login');
    }
   }

   public function sellpreview(){
    if(session('usertype') == 'buyer'){
      if(!empty(session('shipping_ids'))){
        $user = User::where('user_id', Session('user_id'))->first();
        $category = Categories::where('category_id', session('product_category'))->first();
        $selltype = selltype::where('sell_type_id', session('sell_type_id'))->first();
		$attributes = session('attributes');
        $subcategory = Categories::where('category_id', session('product_subcategory'))->first();
        return view('sellpreview')->with('userData',$user)->with('category',$category)->with('selltype',$selltype)->with('subcategory',$subcategory)->with('attributes',$attributes);
      }
      else{
        return redirect('/buyerdashboard/sellstepthree')->with('error','please fill the initial details first');
      }
    }
    else{
      return redirect('/login');
    }
   }

   public function dosellpreview(){
    if(session('usertype') == 'buyer'){
      $user = User::where('user_id', Session('user_id'))->first();
      $products = session::get('attributes');
      //  echo "<pre>";
      //  print_r(count($products));
      //  exit;
      for($i=0; $i<count($products); $i++){
        $index = Products::get();
        if(count($index) == 0){
          $index_value = 1;
        }
        else{
          $index_value = Products::with('index_value')->max('index_value');
          $index_value = $index_value + 1;
        }
        $product = new Products;
        $product->product_name = session('product_name');
        $product->seller_id = session('user_id');
        $product->weight = session('weight');
        $product->product_images = session('product_images');
        $product->product_status = session('product_status');
        $product->product_description = session('product_description');
        $product->location = session('location');
        $product->product_category = session('product_category');
        $product->product_subcategory = session('product_subcategory');
        $product->keywords = session('keywords');
        $product->sell_type_id = session('sell_type_id');
        $product->created_by = session('user_id');
        $product->updated_by = session('user_id');
        $product->status_value = 1;
        $product->index_value = $index_value;
        if(Session::has('image1')){
          $product->product_image_1 = session('image1');
        }
        if(Session::has('image2')){
          $product->product_image_2 = session('image2');
        }
        if(Session::has('image3')){
          $product->product_image_3 = session('image3');
        }
        $product->save();
  	    $id = $product->id;
        foreach($products[$i] as $products1){
          if($products1['attribute_id'] == 'quantity'){
            DB::table('products')->where('product_id',$id)->update(['stock'=>$products1['attribute_value']]);
          }
          else if($products1['attribute_id'] == 'display_price'){
            DB::table('products')->where('product_id',$id)->update(['product_price'=>$products1['attribute_value']]);
          }
          else if($products1['attribute_id'] == 'selling_price'){
            DB::table('products')->where('product_id',$id)->update(['display_price'=>$products1['attribute_value']]);
          }
          else if($products1['attribute_id'] == 'discount_value'){
            DB::table('products')->where('product_id',$id)->update(['seller_discount'=>$products1['attribute_value']]);
          }
          else if($products1['attribute_id'] == 'after_discount'){
            DB::table('products')->where('product_id',$id)->update(['price_after_discount'=>$products1['attribute_value']]);
          }
          else{
            $attribute = new product_attributes;
      		  $attribute->product_id = $id;
      		  $attribute->attribute_id = $products1['attribute_id'];
      		  $attribute->sell_type_id = $products1['sell_type'];
      		  $attribute->value = $products1['attribute_value'];
      		  $attribute->save();
          }
    	  }
        $shipping = session('shipping_ids');
        foreach($shipping as $item){
          DB::table('product_shippings')->insert([
            'product_id'=>$id,
            'shipping_id'=>$item,
            'created_at'=>date('Y-m-d H:i:s')
          ]);
        }
      }

	  // $link = URL::to('/');
	  // if(session('sell_type_id') == 1){
		//   $link .= "/public/product-detail/".$product->id;
	  // }
      Session::forget('product_name');
      Session::forget('actual_price');
      Session::forget('selling_price');
      Session::forget('product_images');
      Session::forget('product_description');
      Session::forget('product_category');
      Session::forget('product_subcategory');
      Session::forget('keywords');
      Session::forget('sell_type_id');
      Session::forget('discount');
      Session::forget('discount_price');
      Session::forget('image1');
      Session::forget('image2');
      Session::forget('image3');
      return redirect('/buyerdashboard')->with('success','Product is Added');
    }
   }

// edited by kartik.
   public function listing(Request $request){

    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
   // $pagination= $request->input('pagination');
    $pagination= 15;
    if($request->input('pagination') != ''){
      $pagination= $request->input('pagination');
    }
    $sort= $request->input('sort');
    $filter= $request->input('filter');
    
    // $perPage = $request->input("per_page",5);
    // $page = $request->input("page", 1);
    // $skip = $page * $perPage;
    // $take = "";
    // if($take < 1) { $take = 1; }
    // if($skip < 0) { $skip = 0; }
// start filter.
   switch ($filter) {
     case '5':
      //DB::enableQueryLog();
       $filter_data = DB::table('products')   
                      ->selectRaw('*')
                      ->whereRaw('price_after_discount between 0 and 99')
                      ->paginate($pagination);     
       break;
     case '6':
       $filter_data = DB::table('products')   
                      ->selectRaw('*')
                      ->whereRaw('price_after_discount between 100 and 199')
                      ->paginate($pagination);
       break;
     case '7':
        $filter_data = DB::table('products')   
                      ->selectRaw('*')
                      ->whereRaw('price_after_discount between 200 and 399')
                      ->paginate($pagination);
        break;
      case '8':
        $filter_data = DB::table('products')   
                      ->selectRaw('*')
                      ->whereRaw('price_after_discount between 400 and 999')
                      ->paginate($pagination);
        break;
        case '9':
          $filter_data = DB::table('products')   
                      ->selectRaw('*')
                      ->whereRaw('price_after_discount  > 999')
                      ->paginate($pagination);
          break;
     default:
          $filter_data = DB::table('products')   
                      ->selectRaw('*')
                      ->whereRaw('price_after_discount >= 0')
                      ->paginate($pagination);
       break;
   }
// end filter.

// start sort.
   switch ($sort) {
     case '1':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->orderBy('product_name','asc')
                        ->paginate($pagination);
       break;
    case '2':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->orderBy('product_name','desc')
                        ->paginate($pagination);
      break;
     case '3':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->orderBy('display_price','asc')
                        ->paginate($pagination);
       break;
      case '4':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->orderBy('display_price','desc')
                        ->paginate($pagination);
        break;
      case '5':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw('product_reviews.rating > 3')
                        ->paginate($pagination);
        break;
      case '6':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw('product_reviews.rating < 5')
                        ->paginate($pagination);
        break;
     default:
       # code...
       break;
   }
// end sort.

    $products = Products::where('sell_type_id', 1)->paginate(8);
    $categories = Categories::where('parent_id', 0)->get();

    return view('products.listing')->with('products',$products)->with('userData', $userData)->with('categories',$categories)->with('filter_data',$filter_data);
   }
// end here.

   public function getAddToCart(Request $request, $id){
    if(session::has('usertype') && session('usertype') == 'buyer'){
      $product = Products::where('product_id', $id)->first();
      $shipping = DB::table('product_shippings')->where('product_id',$id)->get();
      $userData = User::where('user_id', Session('user_id'))->first();
      $country = $userData->country;
      $flag = 0;
      $ship_id = 0;
      foreach($shipping as $item){
        $shipping_id = $item->shipping_id;
        $country_ship = DB::table('seller_shippings')->where('id',$shipping_id)->first();
        if($country == $country_ship->to_country){
          $ship_id = $shipping_id;
          $flag = 1;
        }
      }
      if($flag == 1 && $ship_id !=0){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->product_id, $ship_id);
        $request->session()->put('cart', $cart);
        return redirect(URL::previous())->with('success', 'Item added to your Cart');
      }
      else{
        return redirect(URL::previous())->with('error', 'Item does not ship to your location');
      }
    }
    else{
      return redirect('/login')->with('error','Please login to continue');
    }
   }

   public function getRemoveFromCart(Request $request, $id){
    $product = Products::where('product_id', $id)->first();
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->remove($product, $product->product_id);
    $request->session()->put('cart', $cart);
    return redirect(URL::previous());
   }

   public function getCart(){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
    if(!Session::has('cart')){
      return view('products.cart')->with('userData', $userData);
    }
    $oldcart = Session::get('cart');
    $cart = new Cart($oldcart);
    return view('products.cart', ['products' => $cart->items, 'totalqty' =>$cart->totalQty, 'totalprice' => $cart->totalPrice, 'userData' => $userData]);
   }

   public function getRemove(Request $request, $id){
    $product = Products::where('product_id', $id)->first();
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->removeFromCart($product, $product->product_id);

    $request->session()->put('cart', $cart);
    return redirect('/shopping-cart');
   }

   public function huntlisting(){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
        }
      $products = hunt_products::paginate(8);
      $categories = Categories::where('parent_id', 0)->get();
      return view('products.hunt-listing')->with('userData',$userData)->with('products',$products)->with('categories',$categories);
  }

// edited by kartik.
  public function showproductdetail($id){
          if(session('usertype') == 'buyer')
          {
            $userData = User::where('user_id', Session('user_id'))->first();
          }
          else{
                $userData = null;
              }

          $reviewAllRecords = DB::table('product_reviews')->get();

          // $getUserNameAfterJoin = DB::table('users')
          //                           ->join('product_reviews','product_reviews.user_id','=','users.user_id')
          //                           ->select(['users.first_name','users.last_name'])
          //                           ->get();
          //print_r($getUserNameAfterJoin);

          $featured = $this->featured();
          $product = Products::where('product_id',$id)->where('sell_type_id', 1)->first();
          $categories = Categories::where('parent_id', 0)->get();
          $shipping = DB::table('product_shippings')->where('product_id',$id)->get();
          
          $attributes = DB::table('product_attributes')->select('product_attributes.*','attribute_groups.attribute_name')->join('attribute_groups', 'attribute_groups.id', '=', 'product_attributes.attribute_id')->where('product_attributes.product_id',$id)->get();

          if(count($product) == 0){
            return view('errors.404')->with('userData',$userData);
          }

          if(!Session::has('cart')){
            return view('products.product-detail')->with('userData',$userData)->with('product',$product)->with('categories', $categories)->with('featured', $featured)->with('attributes',$attributes)->with('shipping',$shipping)->with('reviewList',$reviewAllRecords);
          }

          $oldcart = Session::get('cart');
          $cart = new Cart($oldcart);

          return view('products.product-detail', ['products' => $cart->items, 'totalqty' =>$cart->totalQty, 'totalprice' => $cart->totalPrice, 'userData' => $userData])->with('product',$product)->with('categories', $categories)->with('featured', $featured)->with('shipping',$shipping)->with('attributes',$attributes)>with('reviewList',$reviewAllRecords);
  }
// end here.

// set reviewProduct() for functionality of review by kartik.
public function reviewProduct(Request $request){

        $dataInsert = [];
        $dataInsert['user_id']    = $request->input('hidden_user_id');
        $dataInsert['product_id'] = $request->input('hidden_product_id');
        $dataInsert['message']    = $request->input('textarea');
        $dataInsert['rating']     = $request->input('rating');
        $dataInsert['status']     = 1;
        $dataInsert['created_at'] = DB::raw('CURRENT_TIMESTAMP');

        DB::table('product_reviews')->insert($dataInsert);
   
}
// end reviewProduct() here.

  public function swaplisting(Request $request){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
    $pagination= 15;
    $filter_data = Products::where('sell_type_id', 4)->paginate(8);
    $categories = Categories::where('parent_id', 0)->get();
        
    if($request->input('pagination') != ''){
      $pagination= $request->input('pagination');
    }
    $sort= $request->input('sort');
    $filter= $request->input('filter');
    $trigger = "";
// start filter.
   switch ($filter) {
     case '5':
      //DB::enableQueryLog();
     $trigger = 'price_after_discount between 0 and 99 and sell_type_id = 4';     
       break;
     case '6':
     $trigger = 'price_after_discount between 100 and 199 and sell_type_id = 4';     
     case '7':
     $trigger = 'price_after_discount between 200 and 399 and sell_type_id = 4';     
        break;
      case '8':
     $trigger = 'price_after_discount between 400 and 999 and sell_type_id = 4';     
        break;
        case '9':
     $trigger = 'price_after_discount  > 999 and sell_type_id = 4';     

          
          break;
     default:
     $trigger = ' sell_type_id = 4';
       break;
   }
   // start sort.
   switch ($sort) {
     case '1':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('product_name','asc')
                        ->paginate($pagination);
       break;
    case '2':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('product_name','desc')
                        ->paginate($pagination);
      break;
     case '3':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('display_price','asc')
                        ->paginate($pagination);
       break;
      case '4':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('display_price','desc')
                        ->paginate($pagination);
        break;
      case '5':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw($trigger.' and product_reviews.rating > 3')
                        ->paginate($pagination);
        break;
      case '6':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw($trigger.' and product_reviews.rating < 5')
                        ->paginate($pagination);
        break;
     default:
       $filter_data = Products::whereRaw($trigger)
        ->paginate($pagination); 
       break;
  }
// end sort.
    return view('products.swap-listing')->with('userData',$userData)->with('filter_data',$filter_data)->with('categories',$categories);
  }

  public function showswapdetail($id){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
    $product = Products::where('product_id',$id)->where('sell_type_id', 4)->first();
    $categories = Categories::where('parent_id', 0)->get();
    $attributes = DB::table('product_attributes')->select('product_attributes.*','attribute_groups.attribute_name')->join('attribute_groups', 'attribute_groups.id', '=', 'product_attributes.attribute_id')->where('product_attributes.product_id',$id)->get();
    $featured = $this->featured();
    if(count($product) == 0){
      return view('errors.404')->with('userData',$userData);
    }
    return view('products.swap-detail')->with('userData',$userData)->with('product',$product)->with('categories', $categories)->with('featured',$featured)->with('attributes',$attributes);
  }

  public function hunt_detail($id){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
    $product = hunt_products::where('hunt_id',$id)->first();
    $categories = Categories::where('parent_id', 0)->get();
    $featured = $this->featured();
    if(count($product) == 0){
      return view('errors.404')->with('userData',$userData);
    }
    return view('products.hunt-detail')->with('userData',$userData)->with('product',$product)->with('categories', $categories)->with('featured', $featured);
  }

  public function empty_cart(){
    if(!Session::has('cart')){
      return redirect('/shopping-cart')->with('error', 'Your cart is already empty');
    }
    else{
      Session::forget('cart');
      return redirect('/shopping-cart')->with('success', 'Your cart emptied');
    }
  }

// edited by kartik.
  public function showcategory($id ,Request $request){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
    $pagination= 15;
    if($request->input('pagination') != ''){
      $pagination= $request->input('pagination');
    }
    $sort= $request->input('sort');
    $filter= $request->input('filter');
    $getCategoryId = Categories::select('category_id')->where('category_name',$id)->get();
    $category_id  = $getCategoryId[0]['category_id'];
    $subCategories = Categories::where('parent_id',$category_id)->get();
    $categories = Categories::where('parent_id', 0)->get();
    $trigger = "";
    //$filter_data;
    //echo $id;
    //exit();
// start filter.
  
   switch ($filter) {
     case '5':
     // DB::enableQueryLog();
        $trigger = 'price_after_discount between 0 and 99 and sell_type_id = 1 and product_category='.$category_id;   
       break;
     case '6':
     $trigger = 'price_after_discount between 100 and 199 and sell_type_id = 1 and product_category='.$category_id;
       break;
     case '7':
     $trigger = 'price_after_discount between 200 and 399 and sell_type_id = 1 and product_category='.$category_id;
        break;
      case '8':
      $trigger = 'price_after_discount between 400 and 999 and sell_type_id = 1 and product_category='.$category_id;
        break;
        case '9':
        $trigger = 'price_after_discount  > 999 and sell_type_id = 1 and product_category='.$category_id;
          break;
     default:
        $trigger = 'sell_type_id = 1 and product_category='.$category_id;
       break;
   }
// end filter.

// start sort.
   switch ($sort) {
     case '1':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->orderBy('product_name','asc')
                        ->whereRaw($trigger)
                        ->paginate($pagination);
       break;
    case '2':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('product_name','desc')
                        ->paginate($pagination);
      break;
     case '3':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('display_price','asc')
                        ->paginate($pagination);
       break;
      case '4':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('display_price','desc')
                        ->paginate($pagination);
        break;
      case '5':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw($trigger.' and product_reviews.rating > 3')
                        ->paginate($pagination);
        break;
      case '6':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw($trigger.' and product_reviews.rating < 5')
                        ->paginate($pagination);
        break;
     default: 
        $filter_data = Products::whereRaw($trigger)
        ->paginate($pagination);         
       break;
   }

// end sort.
    return view('products.show-category')->with('userData', $userData)->with('filter_data', $filter_data)->with('subCategories', $subCategories)->with('categories',$categories)->with('parentId',$id);
  }

  public function showsubcategory($id, Request $request){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
    $pagination= 15;
    if($request->input('pagination') != ''){
      $pagination= $request->input('pagination');
    }
    $sort= $request->input('sort');
    $filter= $request->input('filter');

    $getCategoryId = Categories::select('category_id')->where('category_name',$id)->get();
    //$products = Products::where('product_subcategory', $getCategoryId[0]['category_id'])->where('sell_type_id', 1)->paginate(8);
    $category_id  = $getCategoryId[0]['category_id'];
    $subCategories = Categories::where('parent_id', $category_id)->get();
    $categories = Categories::where('parent_id', 0)->get();
    $trigger = "";
// start filter.
   switch ($filter) {
     case '5':
      //DB::enableQueryLog();
     $trigger = 'price_after_discount between 0 and 99 and sell_type_id = 1 and product_category='.$category_id; 
       break;
     case '6':
     $trigger = 'price_after_discount between 100 and 199 and sell_type_id = 1 and product_category='.$category_id; 
       break;
     case '7':
     $trigger = 'price_after_discount between 200 and 399 and sell_type_id = 1 and product_category='.$category_id; 
        break;
      case '8':
     $trigger = 'price_after_discount between 400 and 999 and sell_type_id = 1 and product_category='.$category_id; 
        break;
        case '9':
     $trigger = 'price_after_discount  > 999 and sell_type_id = 1 and product_category='.$category_id; 
          break;
     default:
     $trigger = 'sell_type_id = 1 and product_category='.$category_id; 
       break;
   }
// end filter.

// start sort.
   switch ($sort) {
     case '1':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('product_name','asc')
                        ->paginate($pagination);
       break;
    case '2':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('product_name','desc')
                        ->paginate($pagination);
      break;
     case '3':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('display_price','asc')
                        ->paginate($pagination);
       break;
      case '4':
       $filter_data = DB::table('products')
                        ->selectRaw('*')
                        ->whereRaw($trigger)
                        ->orderBy('display_price','desc')
                        ->paginate($pagination);
        break;
      case '5':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw($trigger.' and product_reviews.rating > 3')
                        ->paginate($pagination);
        break;
      case '6':
        $filter_data = DB::table('products')
                        ->join('product_reviews','products.product_id','=','product_reviews.product_id')
                        ->selectRaw('products.*')
                        ->whereRaw($trigger.' and product_reviews.rating < 5')
                        ->paginate($pagination);
        break;
     default:
       $filter_data = Products::whereRaw($trigger)
        ->paginate($pagination); 
       break;
  }
// end sort.
    return view('products.show-subcategory')->with('userData', $userData)->with('filter_data', $filter_data)->with('subCategories', $subCategories)->with('categories',$categories)->with('parentId',$id);
  }
// end here.

  public function search(Request $request){
    if(session('usertype') == 'buyer'){
      $userData = User::where('user_id', Session('user_id'))->first();
    } else{
      $userData = null;
    }
    $featured = $this->featured();
    $daily = $this->daily();
    $categories = Categories::where('parent_id', 0)->get();
    if($request->has('cat')){
      $products_sell = Products::where('product_category', $request->input('cat'))->where('sell_type_id', 1)->where('product_name', 'like', '%'.$request->input('search').'%')->paginate(8);
      $products_hunt = hunt_products::where('product_category', $request->input('cat'))->where('product_name', 'like', '%'.$request->input('search').'%')->paginate(8);
      $products_swap = Products::where('product_category', $request->input('cat'))->where('sell_type_id', 4)->where('product_name', 'like', '%'.$request->input('search').'%')->paginate(8);
    }
    else{
      $products_sell = Products::where('sell_type_id', 1)->where('product_name', 'like', '%'.$request->input('search').'%')->paginate(8);
      $products_hunt = hunt_products::where('product_name', 'like', '%'.$request->input('search').'%')->paginate(8);
      $products_swap = Products::where('sell_type_id', 4)->where('product_name', 'like', '%'.$request->input('search').'%')->paginate(8);
    }
    return view('products.search-listing')->with('userData', $userData)->with('products_sell', $products_sell)->with('products_hunt', $products_hunt)->with('products_swap', $products_swap)->with('categories', $categories)->with('featured', $featured)->with('daily', $daily);
  }

  public function hunt_product_detail(Request $request, $id){
      if(session('usertype') == 'buyer'){
          $userData = User::where('user_id', Session('user_id'))->first();
          $validator = Validator::make($request->all(), [
              'image'=>'required|mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
              'image1'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
              'image2'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
              'image3'=>'mimes:jpeg,bmp,png,jpg|dimensions:min_width=500,min_height=500',
              'productname'=>'required|max:100|unique:hunt_sellers,product_name',
              'price'=>'required|numeric|min:0',
              'description'=>'required',
          ]);
          if ($validator->fails()) {
              return redirect('/hunt-detail/'.$id)->with('error','Please check the values entered');
          }
          else{
              $destination = base_path().'/public/images/hunt_seller';
              $current_time = Carbon::now();
              $extension = $request->file('image')->getClientOriginalExtension();
              $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second;
              $fileName = $date.'.'.$extension;
              $request->file('image')->move($destination, $fileName);
              if($request->file('image1')){
                  $current_time = Carbon::now();
                  $extension = $request->file('image1')->getClientOriginalExtension();
                  $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'1';
                  $fileName1 = $date.'.'.$extension;
                  $request->file('image1')->move($destination, $fileName1);
              }
              if($request->file('image2')){
                  $current_time = Carbon::now();
                  $extension = $request->file('image2')->getClientOriginalExtension();
                  $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'2';
                  $fileName2 = $date.'.'.$extension;
                  $request->file('image2')->move($destination, $fileName2);
              }
              if($request->file('image3')){
                  $current_time = Carbon::now();
                  $extension = $request->file('image3')->getClientOriginalExtension();
                  $date = $current_time->year.$current_time->month.$current_time->day.$current_time->hour.$current_time->minute.$current_time->second.'3';
                  $fileName3 = $date.'.'.$extension;
                  $request->file('image3')->move($destination, $fileName3);
              }
              $huntseller = new hunt_seller;
              $huntseller->product_name = $request->input('productname');
              $huntseller->product_image = $fileName;
              if($request->file('image1')){
                  $huntseller->product_image_1 = $fileName1;
              }
              if($request->file('image2')){
                  $huntseller->product_image_2 = $fileName2;
              }
              if($request->file('image3')){
                  $huntseller->product_image_3 = $fileName3;
              }
              $huntseller->product_description = $request->input('description');
              $huntseller->hunt_id = $id;
              $huntseller->product_price = $request->input('price');
              $huntseller->product_status = 1;
              $huntseller->created_by = session('user_id');
              $huntseller->updated_by = session('user_id');
              $huntseller->save();
              echo 'Request successfully sent to the buyer. Waiting for his confirmation';
          }
      }
      else{
          return redirect('login');
      }
  }

  public function manage_attributes($id){
	if(session('usertype') == 'buyer'){
        $user = User::where('user_id', Session('user_id'))->first();
		$product = Products::where('product_id',$id)->first();
		$subcategory = $product->product_subcategory;
		$attribute_ids = Categories::where('category_id',$subcategory)->first();
		if(count($attribute_ids) == 0){
			$attributes = array();
			return view('buyerdashboard.manage-attributes')->with('userData',$user)->with('error','No manageable attributes found')->with('attributes',$attributes)->with('product_id',$id);
		}
		else{
			$attributes = attributes::whereIn('id',explode(',',$attribute_ids->attributes))->get();
			return view('buyerdashboard.manage-attributes')->with('userData',$user)->with('attributes',$attributes)->with('product_id',$id);
		}
    }
    else{
      return redirect('login');
    }
  }

  public function do_manage_attributes(Request $request, $id){
	if(session('usertype') == 'buyer'){
		  $product = Products::where('product_id',$id)->first();
		  $subcategory = $product->product_subcategory;
		  $attribute_ids = Categories::where('category_id',$subcategory)->first();
		  $attributes = attributes::whereIn('id',explode(',',$attribute_ids->attributes))->get();
		  $attribute_values = array();
		  if(count($request->all()) > 2){
			  $count = (count($request->all()) - 2);
		  }
		  else{
			  $count = 0;
		  }
		  $values = $request->all();
		  $k=0;
		  foreach($attributes as $item){
			  $attribute_values[$k]['attribute_id'] = $item->id;
			  $attribute_values[$k]['attribute_name'] = $item->attribute_name;
			  if($values[$item->id] == 'Others'){
				 $attribute_values[$k]['attribute_value'] = $values[$item->id.'_text'];
			  }
			  else{
				  $attribute_values[$k]['attribute_value'] = $values[$item->id];
			  }
			  $attribute_values[$k]['sell_type'] = $product->sell_type_id;
			  $k++;
		  }

		  product_attributes::where('product_id',$id)->delete();
		  foreach($attribute_values as $item){
			  $attribute = new product_attributes;
			  $attribute->product_id = $id;
			  $attribute->attribute_id = $item['attribute_id'];
			  $attribute->sell_type_id = $item['sell_type'];
			  $attribute->value = $item['attribute_value'];
			  $attribute->save();
		  }
          return redirect('/buyerdashboard/manage-product-attributes')->with('success','Attributes Saved');
    }
    else{
      return redirect('/login');
    }
  }

  public function getInvoice($id){
    $invoice_details = DB::table('invoices')->where('id',$id)->first();
    $invoice = $invoice_details->invoice;
    return view('mails.sell-invoice')->with('invoice',$invoice);
  }
}
