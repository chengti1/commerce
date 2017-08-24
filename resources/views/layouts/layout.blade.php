<!DOCTYPE html>
<!--[if IE 7]> <html lang="en" class="ie7 responsive"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="ie8 responsive"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 responsive"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="responsive"> <!--<![endif]-->
<head>
    <?php
    $cat = App\Categories::where('parent_id', 0)->get();
    ?>
	<title>BUBILAND</title>
	<base  />
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="My Store" />
	<!-- Google Fonts -->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway" />
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{Html::style('catalog/view/theme/stowear/css/bootstrap.css')}}
	{{Html::style('catalog/view/theme/stowear/css/stylesheet.css')}}
	{{Html::style('catalog/view/theme/stowear/css/responsive.css')}}
	{{Html::style('catalog/view/theme/stowear/css/blog.css')}}
	{{Html::style('catalog/view/theme/stowear/css/owl.carousel.css')}}
	{{Html::style('catalog/view/theme/stowear/css/menu.css')}}
	{{Html::style('catalog/view/theme/stowear/css/camera_slider.css')}}
	{{Html::style('catalog/view/theme/stowear/css/filter_product.css')}}
	{{Html::style('catalog/view/theme/stowear/css/wide-grid.css')}}
	{{Html::style('dashboard/css/jquery.tagsinput.css')}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<style>
		.submenu {display: none;}
		/*.popup-gallery, .product-center {width:330px;}*/
		.mainmenu {margin: 1px;line-height: 30px;background: white url(plus.png) left top no-repeat;}
		.mainmenu a{margin: 10px;color: black;text-decoration: none;padding-left:20px;}
		.submenu ul{list-style: none;margin: 0;padding: 0px;}
		.submenu li {background-color: #EEEEEE;margin:0px 0px 1px 4px;line-height: 30px;}
		.submenu li a{color: black;}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	{{Html::script('catalog/view/theme/stowear/js/jquery-migrate-1.2.1.min.js')}}
	{{Html::script('catalog/view/theme/stowear/js/jquery.easing.1.3.js')}}
	{{Html::script('catalog/view/theme/stowear/js/bootstrap.min.js')}}
	{{Html::script('catalog/view/theme/stowear/js/twitter-bootstrap-hover-dropdown.js')}}
	{{Html::script('catalog/view/theme/stowear/js/common.js')}}
	{{Html::script('catalog/view/theme/stowear/js/owl.carousel.min.js')}}
	{{Html::script('catalog/view/theme/stowear/js/jquery.cookie.js')}}
	{{Html::script('catalog/view/theme/stowear/js/jquery.sticky2.js')}}
	{{Html::script('catalog/view/theme/stowear/js/jquery-ui-1.10.4.custom.min.js')}}
	{{Html::script('catalog/view/theme/stowear/js/megamenu.js')}}
	{{Html::script('catalog/view/theme/stowear/js/expandcollapse.js')}}
	{{Html::script('dashboard/js/jquery.tagsinput.js')}}
	{{Html::script('ckeditor/ckeditor.js')}}
	<script type="text/javascript">
        $('#tab1671219 a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
	</script>
	<script type="text/javascript">
        var transition = 'fade';
        var animation_time = 200;
        var responsive_design = 'yes';
	</script>
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="catalog/view/theme/stowear/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div id="notification" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Confirmation</h4>
			</div>
			<div class="modal-body">
				<p></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Continue shopping</button>
				<a href="#" class="btn btn-primary">Checkout</a>
			</div>
		</div>
	</div>
</div>
<div id="quickview" class="modal fade bs-example-modal-lg">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Product</h4>
			</div>
			<div class="modal-body">
				<p></p>
			</div>
		</div>
	</div>
</div>
{{Html::style('catalog/view/javascript/jquery/magnific/magnific-popup.css')}}
{{Html::script('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js')}}
<script type="text/javascript">
    $('body').on('click', '.quickview a', function () {
        $('#quickview .modal-header .modal-title').html($(this).attr('title'));
        $('#quickview .modal-body').load($(this).attr('rel') + ' #quickview_product' ,function(result){
            $('#quickview').modal('show');
            $('#quickview .popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title');
                    }
                }
            });
        });
        return false;
    });
    $('#quickview').on('click', '#button-cart', function () {
        $('#quickview').modal('hide');
        cart.add($(this).attr("rel"));
    });
</script>
<script type="text/javascript">
    $(window).load(function(){
        $("#top .container-megamenu").sticky({ topSpacing: 0 });
    });
</script>
<div class="fixed-body">
	<div id="main" class="main-fixed">
		<div class="hover-product"></div>
		<!-- HEADER
	================================================== -->
		<header>
			<div class="background-header"></div>
			<div class="slider-header">
				<!-- Top Bar -->
				<div id="top-bar" class="full-width">
					<div class="background-top-bar"></div>
					<div class="background">
						<div class="shadow"></div>
						<div class="pattern">
							<div class="container">
								<div class="row">
									<!-- Top Bar Left -->
									<div class="col-sm-3">
										<!-- Welcome text -->
										<div class="welcome-text">
											@if(session('usertype')=='buyer')
												<a id = "loggedinname" href="{{ Request::root() }}/buyerdashboard">Hi! {{$userData->first_name}}</a>
												<a href="{{ Request::root() }}/logout">| Logout	</a>
											@else
												<a id = "loggedinname" href="{{ Request::root() }}/login">Login</a>
												&nbsp;	&nbsp;	&nbsp;
												<a href="{{ Request::root() }}/register">Create an account</a>
											@endif
										</div>
									</div>
									<!-- Top Bar Right -->
									<div class="col-sm-9" id="top-bar-right">
										<form action="#" method="post" enctype="multipart/form-data" id="currency_form">
											<input type="hidden" name="code" value="" />
											<input type="hidden" name="redirect" value="{{ URL::asset('/')}}" />
										</form>
										<!-- Links -->
										<ul class="top-bar-links">
											<li><a href="{{URL::asset('/')}}hunt-listing" id="hunt">Hunt Item</a></li>
											<li><a href="{{URL::asset('/')}}swap-listing" id="swap">Swap Item</a></li>
											<li><a href="{{URL::asset('/')}}listing" id="buy">Buy Products</a></li>
											<!--<li><a href="#" id="wishlist-total">Wish List (0)</a></li>-->
											<li><a href="{{Request::root()}}/buyerdashboard">My Account</a></li>
											<li>
												<a href="{{route('product.shoppingCart')}}">
													Shopping Cart
													<span class = "badge"> {{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}
												</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Top of pages -->
				<div id="top" class="full-width">
					<div class="background-top"></div>
					<div class="background">
						<div class="shadow"></div>
						<div class="pattern">
							<div class="container">
								<div class="row">
									<!-- Header Left -->
									<div class="col-sm-4" id="header-left">
										<!-- Logo -->
										<div class="logo"><a href="{{ URL::asset('/')}}">{{Html::image('image/catalog/logo_stowear.png')}}</a></div>
									</div>
									<!-- Header Right -->
									<div class="col-sm-8" id="header-right">
										<!-- Search -->
										<div class="search_form">
											<div class="button-search"></div>
											<input type="text" class="input-block-level search-query" name="search" placeholder="" id="search_query" value="" />
											<div id="autocomplete-results" class="autocomplete-results"></div>
										</div>
										<div class="advance"><select id = "cat_search">
												<option value = "">Advance Search</option>
												@foreach($cat as $cats)
													<option value = "{{$cats->category_id}}">{{$cats->category_name}}</option>
												@endforeach
											</select></div>
										<!-- Cart block -->
										<div id="cart_block" class="dropdown">
											<div class="cart-heading dropdown-toogle" data-toggle="dropdown">
												{{Html::image('catalog/view/theme/stowear/img/icon-cart.png')}}
												<span id="total_price">${{Session::has('cart') ? Session::get('cart')->totalPrice : '0'}}</span>
											</div>
											<div class="dropdown-menu">
												@if(Session::has('cart'))
                                                    <?php
                                                    $cartitems = session('cart');
                                                    $item = $cartitems->items;
                                                    ?>
													<table class="table table-condensed">
														<thead>
														<tr class="cart_menu">
															<td class="image">Item</td class="image">
															<td class="title">Product Title</td>
															<td class="price">Price</td>
															<td class="quantity">Quantity</td>
															<td class="total">Total</td>
															<td>Remove</td>
														</tr>
														</thead>
														<tbody>
														@foreach($item as $items)
															<tr>
																<td class="cart_product">
																	<a href="{{URL::asset('/')}}product-detail/{{$items['item']['product_id']}}"><img width = "100px" height = "100px" src="{{URL::asset('/')}}images/product_master/{{$items['item']['product_images']}}" alt=""></a>
																</td>
																<td class="cart_description">
																	{{$items['item']['product_name']}}
																</td>
																<td class="cart_price">
																	<p>${{$items['item']['price_after_discount']}}</p>
																</td>
																<td>
																	<div class="cart_quantity_button">
																		<a href='{{route('product.addToCart', ['id' => $items['item']['product_id']])}}'><i class="fa fa-plus"> </i></a>
																		{{$items['qty']}}
																		<a href="{{route('product.removeFromCart', ['id' => $items['item']['product_id'] ])}}"><i class="fa fa-minus"> </i></a>
																	</div>
																</td>
																<td class="cart_total">
																	<p class="cart_total_price">${{$items['price']}}</p>
																</td>
																<td class="cart_delete">
																	<a href="{{route('product.removeCartItem', ['id' => $items['item']['product_id'] ])}}" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
																</td>
															</tr>
														@endforeach
														</tbody>
													</table>
													<div class = "row">
														<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
															<button type="button" onClick = "location.href = '{{Request::root()}}/payment'" class = "btn btn-success">Proceed to Checkout</button>
															<div>
															</div><br>
														</div>
													</div>
													</section>
												@else
													No Items in Your Cart
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
							<script type="text/javascript">
                                transition = 'none';
                                animation_time = 350;
							</script>
						</div>
					</div>
				</div>
			</div>
			@yield('content')
		</header>
		<!-- CUSTOM FOOTER
            ================================================== -->
		<div class="custom-footer full-width">
			<div class="background-custom-footer"></div>
			<div class="background">
				<div class="shadow"></div>
				<div class="pattern">
					<div class="container">
						<div class="row">
							<!-- About us -->
							<div class="col-md-3 col-sm-6">
								<h4>About us</h4>
								<img src="{{ URL::asset('/')}}image/catalog/logo_stowear_footer.png" alt="stowear" style="margin-top: 7px">
								<p style="padding-top: 30px;line-height: 21px"><b style="font-size: 16px;color: #262626">Awesome theme with nice & modern design</b></p>
								<p style="padding-top: 10px; margin-bottom: 0px">Stowear is beautyfull OpenCart theme with a lots of features. Build with HTML 5 & CSS 3.</p>
							</div>
							<!-- Contact -->
							<div class="col-md-3 col-sm-6">
								<h4>Contact</h4>
								<ul class="contact-us clearfix">
									<!-- Phone -->
									<li>
										<i class="fa fa-phone"></i>
										<p>
											+48 661 662 663<br>
											(032) 156 147 158
										</p>
									</li>
									<!-- Email -->
									<li>
										<i class="fa fa-envelope"></i>
										<p>
											<span>office@example</span><br>
											<span>info@ask.com</span>
										</p>
									</li>
									<!-- Phone -->
									<li>
										<i class="fa fa-skype"></i>
										<p>
											skypelogin<br>
											profileskype
										</p>
									</li>
								</ul>
							</div>
							<!-- Twitter -->
							<div class="col-md-3 col-sm-6">
								<h4>Twitter</h4>
								<div style="position: relative;margin-top: -14px;margin-bottom: -14px;"><a class="twitter-timeline"  href="https://twitter.com/@Themenis2" data-chrome="noheader nofooter noborders noscrollbar transparent" data-tweet-limit="2"  data-widget-id="407198994117324800" data-theme="light" data-related="twitterapi,twitter" data-aria-polite="assertive">Tweets by @Themenis2</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
                                        window.setTimeout(function(){
                                            $(".twitter-timeline").contents().find(".e-entry-title").css("font-size","12px");
                                            $(".twitter-timeline").contents().find(".tweet").css("font-size","12px");
                                            $(".twitter-timeline").contents().find(".p-name").css("font-size","12px");
                                        }, 1000);</script></div>
							</div>
							<!-- Custom block -->
							<div class="col-md-3 col-sm-6">
								<h4>Custom block</h4>
								<p><img src="{{ URL::asset('/')}}image/catalog/custom_block.png" alt="Custom block"></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- FOOTER
            ================================================== -->
		<div class="footer full-width">
			<div class="background-footer"></div>
			<div class="background">
				<div class="shadow"></div>
				<div class="pattern">
					<div class="container">
						<div class="row">
							<!-- Information -->
							<div class="col-sm-3 col-xs-6 footer-panel">
								<h4>Information</h4>
								<ul>
									<li><a href="#">About Us</a></li>
									<li><a href="#">Delivery Information</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Terms &amp; Conditions</a></li>
								</ul>
							</div>
							<!-- Customer Service -->
							<div class="col-sm-3 col-xs-6 footer-panel">
								<h4>Customer Service</h4>
								<ul>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Returns</a></li>
									<li><a href="#">Site Map</a></li>
								</ul>
							</div>
							<!-- Extras -->
							<div class="col-sm-3 col-xs-6 footer-panel">
								<h4>Extras</h4>
								<ul>
									<li><a href="#">Brands</a></li>
									<li><a href="#">Gift Vouchers</a></li>
									<li><a href="#">Affiliates</a></li>
									<li><a href="#">Specials</a></li>
								</ul>
							</div>
							<!-- My Account -->
							<div class="col-sm-3 col-xs-6 footer-panel">
								<h4>My Account</h4>
								<ul>
									<li><a href="#">My Account</a></li>
									<li><a href="#">Order History</a></li>
									<li><a href="#">Wish List</a></li>
									<li><a href="#">Newsletter</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- COPYRIGHT
            ================================================== -->
		<div class="copyright full-width">
			<div class="background-copyright"></div>
			<div class="background">
				<div class="shadow"></div>
				<div class="pattern">
					<div class="container">
						<div class="line"></div>
						<ul>
							<li><img src="{{ URL::asset('/')}}image/catalog/paypal.png" alt=""></li><li><img src="{{ URL::asset('/')}}image/catalog/mastercard.png" alt=""></li><li><img src="{{ URL::asset('/')}}image/catalog/visa.png" alt=""></li><li><img src="{{ URL::asset('/')}}image/catalog/american-express.png" alt=""></li>					</ul>
						<p>Powered By <a href="#">Neurons-IT</a>. &copy; <?= date('Y') ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.button-search').click(function(){
            var search = $('#search_query').val();
            var category = $('#cat_search').val();
            window.location = "{{Request::root()}}/search?cat="+category+"&search="+search;
        })
    })
</script>
</body>
</html>