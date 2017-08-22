<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix' => 'buyerdashboard'], function () {
    Route::get('/', 'UserController@buyerdashboard');
    Route::get('/changesellerpassword', 'DashboardController@changeSellerPassword');
    Route::post('/changesellerpassword', 'DashboardController@dochangeSellerPassword');
    Route::get('/changepmethod', 'DashboardController@changepmethod');
    Route::post('/changepmethod', 'DashboardController@dochangepmethod');
    Route::get('/updateprofile', 'DashboardController@updateprofile');
    Route::post('/updateprofile', 'DashboardController@doupdateprofile');
    Route::get('/sellitem','DashboardController@sellitem');
    Route::post('/sellitem','DashboardController@dosellitem');
    Route::get('/getsubcategory','DashboardController@getsubcategory');
    Route::post('/sellstepone','ProductController@sellstepone');
    Route::get('/sellsteptwo','ProductController@sellsteptwo');
    Route::post('/sellsteptwo','ProductController@dosellsteptwo');
    Route::get('/sellstepthree','ProductController@sellstepthree');
    Route::post('/sellstepthree','ProductController@dosellstepthree');
    Route::get('/sellpreview','ProductController@sellpreview');
    Route::post('/sellpreview','ProductController@dosellpreview');
    Route::get('/deletepmethod','DashboardController@deletepmethod');
    Route::get('/addpmethod','DashboardController@addpmethod');
    Route::post('/addpmethod','DashboardController@doaddpmethod');
    Route::get('/hunt-an-item','DashboardController@huntanitem');
    Route::post('/hunt-an-item','DashboardController@dohuntanitem');
    Route::get('/messages','DashboardController@user_messages');
    Route::post('/swapconfirmbuyer/{id}','DashboardController@swapconfirmbuyer');
    Route::get('/view-swap-request', 'DashboardController@viewswaprequest');
    Route::get('/view-confirm-swap-request', 'DashboardController@viewconfirmswaprequest');
    Route::get('/sell-leads','DashboardController@sell_leads');
    Route::get('/buy-leads','DashboardController@buy_leads');
    Route::get('/deletemessage/{id}','DashboardController@delete_message');
    Route::get('/manage-product-attributes','DashboardController@managepattributes');
    Route::get('/manage-coupons', 'DashboardController@manage_coupons');
    Route::get('/add-coupon', 'DashboardController@add_coupons');
    Route::post('/add-coupon', 'DashboardController@doadd_coupons');
    Route::get('/delete-coupon/{id}', 'DashboardController@delete_coupon');
    Route::get('/update-coupon/{id}', 'DashboardController@update_coupon');
    Route::post('/update-coupon/{id}', 'DashboardController@doupdate_coupon');
    Route::get('/manage-rules/{id}', 'DashboardController@manage_rules');
    Route::get('/add-rule/{id}', 'DashboardController@add_rules');
    Route::post('/add-rule/{id}', 'DashboardController@doadd_rules');
    Route::get('/delete-rule/{id}', 'DashboardController@delete_rules');
    Route::get('/update-rule/{id}', 'DashboardController@update_rules');
    Route::post('/update-rule/{id}', 'DashboardController@doupdate_rules');
    Route::post('/hunt-product-detail/{id}', 'ProductController@hunt_product_detail');
    Route::get('/view-hunt-request', 'DashboardController@view_hunt_request');
    Route::get('/view-hunt/{id}', 'DashboardController@do_view_hunt_request');
    Route::get('/confirm-hunt-buyer/{id}', 'paypalAdaptiveController@buyer_confirm_hunt');
    Route::get('/view-confirm-hunt-request', 'DashboardController@view_confirm_hunt');
    Route::get('/confirm-hunt-seller/{id}', 'PaypalController@seller_confirm_hunt');
    Route::get('/seller-view-hunt/{id}', 'DashboardController@view_seller_hunt');
    Route::get('/view-buyer-swap/{id}', 'DashboardController@view_buyer_swap');
    Route::get('/add-attribute-groups','DashboardController@add_attribute_group');
    Route::post('/add-attribute-groups','DashboardController@do_add_attribute_group');
    Route::get('/add-attributes/{id}','DashboardController@add_attributes');
    Route::post('/add-attributes/{id}','DashboardController@do_add_attributes');
    Route::get('/getAttributes','DashboardController@get_attributes');
    Route::get('/manage-attributes/{id}','DashboardController@manage_attributes');
    Route::get('/delete-attributes/{id}','DashboardController@delete_attributes');
    Route::get('/change-attribute/{id}','DashboardController@change_attribute');
    Route::post('/change-attribute/{id}','DashboardController@do_change_attribute');
    Route::get('/swap-transactions','DashboardController@swap_transactions');
    Route::get('/hunt-transactions','DashboardController@hunt_transactions');
    Route::get('/manage-shipping','DashboardController@manage_shipping');
    Route::post('/manage-shipping','DashboardController@do_manage_shipping');
    Route::post('/getToShipping','DashboardController@getToCountries');
});

Route::group(['prefix' => 'admindashboard'], function () {
    Route::get('/','AdminController@admindashboard');
    Route::get('/managecategories','AdminController@managecategories');
    Route::get('/viewsubcategories','AdminController@viewsubcategories');
    Route::get('/managebrands','AdminController@managebrands');
    Route::get('/auctioncategories','AdminController@auctioncategories');
    Route::get('/addproductcategory','AdminController@addproductcategory');
    Route::post('/addproductcategory','AdminController@doaddproductcategory');
    Route::get('/editproductcategory','AdminController@editproductcategory');
    Route::post('/editproductcategory','AdminController@doeditproductcategory');
    Route::get('/deleteproductcategory','AdminController@deleteproductcategory');
    Route::get('/addbrand','AdminController@addbrand');
    Route::post('/addbrand','AdminController@doaddbrand');
    Route::get('/editbrands','AdminController@editbrands');
    Route::post('/editbrands','AdminController@doeditbrands');
    Route::get('/deletebrand','AdminController@deletebrand');
    Route::get('/addsubcategory','AdminController@addsubcategory');
    Route::post('/addsubcategory','AdminController@doaddsubcategory');
    Route::get('/deletesubcategory','AdminController@deletesubcategory');
    Route::post('/editsubcategory','AdminController@doeditsubcategory');
    Route::get('/editsubcategory','AdminController@editsubcategory');
    Route::get('/manage-coupons', 'AdminController@manage_coupons');
    Route::get('/hunting-commission', 'AdminController@hunting_commission');
    Route::get('/update-hunt-commission/{id}', 'AdminController@view_update_commission');
    Route::post('/update-hunt-commission/{id}', 'AdminController@do_view_update_commission');
    Route::get('/manage-reports','AdminController@manage_reports');
    Route::get('/manage-products','AdminController@manage_products');
    Route::get('/update-product/{id}','AdminController@update_products');
    Route::post('/update-product/{id}','AdminController@do_update_products');
});

Route::get('/', 'UserController@index');
Route::get('/index', 'UserController@index');
Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@dologin');
Route::get('/register', 'UserController@register');
Route::post('/register', 'UserController@doregister');

Route::get('/logout','UserController@logout');
Route::get('/verify/{confirmationcode}/{userid}','UserController@verify');
Route::get('/redirect/{driver}', 'SocialAuthController@redirect');
Route::get('/callback/{driver}', 'SocialAuthController@callback');


// route for captcha created by kartik.
Route::get('/refereshcapcha', 'UserController@refereshCapcha');
// end captcha route here.


Route::get('/admin','AdminController@adminlogin');
Route::post('/adminlogin','AdminController@doadminlogin');

// edited by kartik.
Route::get('/listing','ProductController@listing');
// end here.
Route::get('/add-to-cart/{id}', [
		'uses' => 'ProductController@getAddToCart',
		'as' => 'product.addToCart'
	]);
Route::get('/shopping-cart', [
		'uses' => 'ProductController@getCart',
		'as' => 'product.shoppingCart'
	]);
Route::get('/remove-from-cart/{id}', [
		'uses' => 'ProductController@getRemoveFromCart',
		'as' => 'product.removeFromCart'
	]);
Route::get('/remove-cart-item/{id}', [
		'uses' => 'ProductController@getRemove',
		'as' => 'product.removeCartItem'
	]);
Route::get('payment', array(

    'as' => 'payment',

    'uses' => 'paypalAdaptiveController@postPayment',

));
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'paypalAdaptiveController@getPaymentStatus',
));

Route::get('/hunt-listing','ProductController@huntlisting');
Route::post('/send-buyer-message','UserController@sendmessage');
Route::get('/product-detail/{id}','ProductController@showproductdetail');

Route::get('/swap-listing','ProductController@swaplisting');
Route::get('/swap-detail/{id}','ProductController@showswapdetail');

Route::get('/payment-swaps/{id}', array(
    'uses' => 'paypalAdaptiveController@splitPaySwapSeller',
));

// set route for review by kartik.
Route::get('product-detail','ProductController@reviewProduct');
// end here.

Route::get('payment/sellerswapstatus', array(
    'as' => 'payment.sellerswapstatus',
    'uses' => 'paypalAdaptiveController@viewreportSwapSeller',
));

Route::get('payment-swapb/{id}', array(
    'uses' => 'paypalAdaptiveController@splitPaySwapBuyer',
));
Route::get('payment/buyerswapstatus', array(
    'as' => 'payment.buyerswapstatus',
    'uses' => 'paypalAdaptiveController@viewreportSwapBuyer',
));

Route::get('/hunt-detail/{id}','ProductController@hunt_detail');
Route::post('/hunt-detail/{id}','ProductController@hunt_product_detail');

Route::get('/empty-cart', 'ProductController@empty_cart');
Route::get('/category/{id}', 'ProductController@showcategory');
Route::get('/subcategory/{id}', 'ProductController@showsubcategory');


Route::get('/search', 'ProductController@search');

Route::get('payment/buyerhuntstatus', array(
    'as' => 'payment.buyerhuntstatus',
    'uses' => 'paypalAdaptiveController@getBuyerHuntPaymentStatus',
));

Route::get('payment/aellerhuntstatus', array(
    'as' => 'payment.sellerhuntstatus',
    'uses' => 'PaypalController@getSellerHuntPaymentStatus',
));


Route::get('adaptive', 'paypalAdaptiveController@splitPay');
Route::get('viewreport', 'paypalAdaptiveController@viewreport');
Route::get('manage-attributes/{id}','ProductController@manage_attributes');
Route::post('manage-attributes/{id}','ProductController@do_manage_attributes');
Route::get('forgot-password','UserController@forgotPassword');
Route::post('forgot-password','UserController@doForgotPassword');

// prashant kumar

Route::get('change-email','UserController@changeEmail');

Route::post('change-email','UserController@doChangeEmail');

// prashant kumar
Route::get('reset/{code}/{id}','UserController@changePassword');
Route::post('reset/{code}/{id}','UserController@doChangePassword');


Route::get('invoice/{id}', 'ProductController@getInvoice');

