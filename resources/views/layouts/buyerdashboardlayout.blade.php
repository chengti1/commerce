<!DOCTYPE html>
<!--[if IE 7]>
<html lang="en" class="ie7 responsive"> <![endif]-->
<!--[if IE 8]>
<html lang="en" class="ie8 responsive"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 responsive"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="responsive"> <!--<![endif]-->

<head>

    <?php
    $cat = App\Categories::where('parent_id', 0)->get();
    ?>

    <title>BUBILAND</title>
    <base/>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="My Store"/>


    <!-- Google Fonts -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway"/>

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
    {{Html::style('js/fullcalendar/fullcalendar.css')}}

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
    {{Html::script('js/fullcalendar/lib/moment.min.js')}}
    {{Html::script('js/fullcalendar/fullcalendar.js')}}


    <style>
        .submenu {
            display: none;
        }

        .mainmenu {
            margin: 1px;
            line-height: 30px;
            background: white url(plus.png) left top no-repeat;
        }

        .mainmenu a {
            margin: 10px;
            color: black;
            text-decoration: none;
            padding-left: 20px;
        }

        .submenu ul {
            list-style: none;
            margin: 0;
            padding: 0px;
        }

        .submenu li {
            background-color: #EEEEEE;
            margin: 3px 5px 1px;
            line-height: 30px;
        }

        .submenu li a {
            color: black;
        }
        /*08.03.2017*/
        @import url('https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i');
        .mainmenu {margin:0; margin-bottom:3px;}
        .mainmenu a {background-color:#51a1f3; font-family: 'Roboto', sans-serif; font-size:14px; color:#fff; font-weight:400; margin: 0; padding: 10px 20px; display:block; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;}
        .mainmenu a .fa {font-size:16px; vertical-align: middle; margin-right:5px;}
        .mainmenu a .fa-chevron-down {float:right; margin-right:0;}
        .submenu li a {background-color: #C18107; font-size:13px; color:#fff;}
    </style>

<script>
$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#fullCalendar').fullCalendar({
        // put your options and callbacks here
    })

});
</script>


    <script>
        $(document).ready(function () {
            var category = $('#categories option:selected').val();
            $.ajax({
                url: '{{ URL::asset('/')}}buyerdashboard/getsubcategory?category_id=' + category,
                type: 'get',
                success: function (subcategory) {
                    $('#scategory').html(subcategory);
                }
            })
        })
    </script>

    <script>
        $(document).ready(function () {
            $('#categories').change(function () {
                var category = $('#categories option:selected').val();
                $.ajax({
                    url: '{{ URL::asset('/')}}buyerdashboard/getsubcategory?category_id=' + category,
                    type: 'get',
                    success: function (subcategory) {
                        $('#scategory').html(subcategory);
                    }
                })
            })
        });
    </script>

	<!-- Prashant Kumar -->

<script type="text/javascript">
    $(document).ready(function () {

            $('#discount').change(function () {
                var sellprice = parseInt($('#sellprice').val());
                var discount = parseInt($('#discount').val());

                // getting discount type
                var radioValue = $("input[name='discount_type']:checked").val();

                // validating discount type
                if(radioValue == "$")
                {
                    //validating discount in $ can't be greater than sellprice
                     if(discount > sellprice)
                     {
                         var discount = 0;
                         var dprice = 0;

                         $('#afterdiscount').html("");
                         alert("you cannot discount more than sellprice."+sellprice);


                     }
                    else
                     {
                         var dprice = sellprice - discount;
                     }


                }
                else
                {
                    //validating discount in % can't be greater than 100 %
                    if(discount >= 100)
                    {
                        var discount = 0;
                        alert("you cannot discount more than 100 % .");
                        var dprice = 0;
                        $('#afterdiscount').html("");
                    }
                    else
                    {
                    var dprice = (sellprice) - (sellprice / 100) * discount;
                    }
                }

                // get discount value after validating all term

                $('#afterdiscount').val(dprice.toFixed(2));

            });

    })
</script>
<!-- Prashant Kumar -->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#discount').keyup(function () {
                var sellprice = $('#sellprice').val();
                var discount = $('#discount').val();
                var dprice = (sellprice) - (sellprice / 100) * discount;
                $('#afterdiscount').val(dprice.toFixed(2));
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('#keywords').tagsInput();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.attribute_values').tagsInput();
        });
    </script>


    <script>
        $(document).ready(function () {
            $(".mainmenu").click(function () {
                if ($(this).children("div.submenu").css("display") == "none") {

                    $(this).children("div.submenu").show();
                } else {

                    $(this).children("div.submenu").hide();
                }
            });
        });
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
                <a href="#/" class="btn btn-primary">Checkout</a>
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
        $('#quickview .modal-body').load($(this).attr('rel') + ' #quickview_product', function (result) {
            $('#quickview').modal('show');
            $('#quickview .popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function (item) {
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
    $(window).load(function () {
        $("#top .container-megamenu").sticky({topSpacing: 0});
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
                                    <div class="col-sm-3 hidden-xs">
                                        <!-- Welcome text -->
                                        <div class="welcome-text">
                                            @if(session('usertype')=='buyer')
                                                <a href="{{  URL::asset('/') }}buyerdashboard">Hi! {{$userData->first_name}}    </a>
                                                <a href="{{  URL::asset('/') }}logout">| Logout </a>
                                            @else
                                                <a href="{{  URL::asset('/') }}login">Login </a>    &nbsp;    &nbsp;
                                                &nbsp;         <a href="{{  URL::asset('/') }}register">Create an
                                                    account </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Top Bar Right -->
                                    <div class="col-sm-9" id="top-bar-right">
                                        <form action="#" method="post" enctype="multipart/form-data" id="currency_form">


                                            <input type="hidden" name="code" value=""/>
                                            <input type="hidden" name="redirect" value="{{ URL::asset('/')}}"/>
                                        </form>

                                        <!-- Links -->
                                        <ul class="top-bar-links">
                                            <li><a href="{{URL::asset('/')}}hunt-listing" id="hunt">Hunt Item</a></li>
                                            <li><a href="{{URL::asset('/')}}swap-listing" id="swap">Swap Item</a></li>
                                            <li><a href="{{URL::asset('/')}}listing" id="buy">Buy Products</a></li>
                                            <li><a href="#/" id="wishlist-total">Wish List (0)</a></li>
                                            <li><a href="{{Request::root()}}/buyerdashboard">My Account</a></li>
                                            <li>
                                                <a href="{{route('product.shoppingCart')}}">
                                                    Shopping Cart
                                                    <span class="badge"> {{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}
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
                                        <div class="logo"><a
                                                    href="{{ URL::asset('/')}}">{{Html::image('image/catalog/logo_stowear.png')}}</a>
                                        </div>
                                    </div>

                                    <!-- Header Right -->
                                    <div class="col-sm-8" id="header-right">

                                        <!-- Search -->
                                        <div class="search_form">
                                            <div class="button-search"></div>
                                            <input type="text" class="input-block-level search-query" name="search"
                                                   placeholder="" id="search_query" value=""/>

                                            <div id="autocomplete-results" class="autocomplete-results"></div>


                                        </div>

                                        <div class="advance"><select id="cat_search">
                                                <option value="">Advance Search</option>
                                                @foreach($cat as $cats)
                                                    <option value="{{$cats->category_id}}">{{$cats->category_name}}</option>
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
                                                            <td class="image">Item</td>
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
                                                                    <a href="{{URL::asset('/')}}product-detail/{{$items['item']['product_id']}}"><img
                                                                                width="100px" height="100px"
                                                                                src="images/product_master/{{$items['item']['product_images']}}"
                                                                                alt=""></a>
                                                                </td>
                                                                <td class="cart_description">
                                                                    {{$items['item']['product_name']}}
                                                                </td>
                                                                <td class="cart_price">
                                                                    <p>${{$items['item']['price_after_discount']}}</p>
                                                                </td>
                                                                <td>
                                                                    <div class="cart_quantity_button">
                                                                        <a href='{{route('product.addToCart', ['id' => $items['item']['product_id']])}}'><i
                                                                                    class="fa fa-plus"> </i></a>
                                                                        {{$items['qty']}}
                                                                        <a href="{{route('product.removeFromCart', ['id' => $items['item']['product_id'] ])}}"><i
                                                                                    class="fa fa-minus"> </i></a>
                                                                    </div>
                                                                </td>
                                                                <td class="cart_total">
                                                                    <p class="cart_total_price">${{$items['price']}}</p>
                                                                </td>
                                                                <td class="cart_delete">
                                                                    <a href="{{route('product.removeCartItem', ['id' => $items['item']['product_id'] ])}}"
                                                                       class="cart_quantity_delete" href=""><i
                                                                                class="fa fa-times"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                                                            <button type="button"
                                                                    onClick="location.href = '{{Request::root()}}/payment'"
                                                                    class="btn btn-success">Proceed to Checkout
                                                            </button>
                                                            <div>
                                                            </div>
                                                            <br>
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
            <!-- MAIN CONTENT
          ================================================== -->
            <div class="main-content full-width home">
                <div class="background-content"></div>
                <div class="background">
                    <div class="shadow"></div>
                    <div class="pattern">
                        <div class="container">

                            <div class="row">
                                <div class="col-sm-12">


                                    <div class="row">
                                        <div class="col-md-3 col-sm-12" id="column_left">
                                            <div class="box dash01">

                                                <div class="box-heading">Dashboard</div>
                                                <div class="strip-line"></div>
                                                <div id="category" class="mainmenu">
                                                    <a href="{{ URL::asset('/')}}buyerdashboard"><i class="fa fa-home"></i> Member Area</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-edit"></i> My Account <span class="fa fa-chevron-down"></span></a>
                                                    <div class="submenu">
                                                        <ul>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/changepmethod">Payment Methods</a></li>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/updateprofile">Update Profile</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-edit"></i> Transaction Reports <span class="fa fa-chevron-down"></span></a>
                                                    <div class="submenu">
                                                        <ul>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/buy-leads">Bought Products</a></li>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/sell-leads">Sold Products</a></li>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/swap-transactions">Swapped Products</a></li>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/hunt-transactions">Hunted Products</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="{{ URL::asset('/')}}buyerdashboard/changesellerpassword"><i class="fa fa-desktop"></i>  Change Password</a>
                                                </div>

                                                @if($userData->is_seller == 1)
                                                    <div id="category" class="mainmenu">
                                                        <a href="{{ URL::asset('/')}}buyerdashboard/manage-coupons"><i class="fa fa-tags"></i>  Manage Coupons</a>
                                                    </div>
                                                @endif

                                                <div id="category" class="mainmenu">
                                                    <a href="{{ URL::asset('/')}}buyerdashboard/manage-shipping"><i class="fa fa-tags"></i>  Manage Shipping</a>
                                                </div>

                                                <div id="category" class="mainmenu">
                                                    <a href="{{ URL::asset('/')}}buyerdashboard/sellitem"><i class="fa fa-table"></i> Sell an Item</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-edit"></i> Swap<span class="fa fa-chevron-down"></span></a>
                                                    <div class="submenu">
                                                        <ul>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/view-swap-request">Swap Requests</a></li>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/view-confirm-swap-request">Confirmed Swap Requests</a></li></li></ul>
                                                    </div>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-edit"></i> Hunt <span class="fa fa-chevron-down"></span></a>
                                                    <div class="submenu">
                                                        <ul>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/view-hunt-request">Hunt Requests</a></li>
                                                            <li><a href="{{ URL::asset('/')}}buyerdashboard/view-confirm-hunt-request">Confirmed Hunt Requests</a></li></li></ul>
                                                    </div>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="{{ URL::asset('/')}}buyerdashboard/hunt-an-item"><i class="fa fa-search"></i>  Hunt an Item</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-shopping-cart"></i> My Store</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-dollar"></i> My Ads</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-line-chart"></i> My Banners</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-trophy"></i> Progress</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-comments-o"></i> MyPosts</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="{{URL::asset('/')}}buyerdashboard/messages"><i class="fa fa-envelope"></i> Messages</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="{{URL::asset('/')}}buyerdashboard/manage-product-attributes"><i class="fa fa-tachometer"></i> Manage Product Attributes</a>
                                                </div>
                                                <div id="category" class="mainmenu">
                                                    <a href="#/"><i class="fa fa-university"></i> Saved Sellers</a>
                                                </div>
                                            </div>

                                            <div class="box">

                                                <div class="box-heading">My recent search</div>
                                                <div class="strip-line"></div>
                                                <div class="box-content products">
                                                    <div class="box-product">
                                                        <div id="myCarousel15765120">
                                                            <!-- Carousel items -->
                                                            <div class="carousel-inner">
                                                                <div class="active item">
                                                                    <div class="product-grid">
                                                                        <div class="row">
                                                                            <div class="col-sm-4 col-xs-6">

                                                                                <!-- Product -->
                                                                            </div>
                                                                            <div class="col-sm-4 col-xs-6">

                                                                                <!-- Product -->
                                                                            </div>
                                                                            <div class="col-sm-4 col-xs-6">

                                                                                <!-- Product -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-9">
                                            <div id="slider" class="full-width">
                                                <div class="background-slider"></div>
                                                <div class="background">
                                                    <div class="shadow"></div>
                                                    <div class="pattern">
                                                        <script type="text/javascript">
                                                            $(document).ready(function () {
                                                                var camera_slider = $("#camera_wrap_1");

                                                                camera_slider.owlCarousel({
                                                                    slideSpeed: 300,
                                                                    singleItem: true,
                                                                    transitionStyle: "fadeUp",
                                                                    autoPlay: 7000,
                                                                    stopOnHover: true,
                                                                    navigation: true
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-product">
                                                <!-- page content -->
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
                                <img src="{{ URL::asset('/')}}image/catalog/logo_stowear_footer.png" alt="stowear"
                                     style="margin-top: 7px">
                                <p style="padding-top: 30px;line-height: 21px"><b
                                            style="font-size: 16px;color: #262626">Awesome theme with nice & modern
                                        design</b></p>
                                <p style="padding-top: 10px; margin-bottom: 0px">Stowear is beautyfull OpenCart theme
                                    with a lots of features. Build with HTML 5 & CSS 3.</p></div>

                            <!-- Contact -->
                            <div class="col-md-3 col-sm-6">
                                <h4>Contact</h4>
                                <ul class="contact-us clearfix">
                                    <!-- Phone -->
                                    <li>
                                        <i class="fa fa-phone"></i>
                                        <p>
                                            +48 661 662 663<br>
                                            (032) 156 147 158 </p>
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
                                            profileskype </p>
                                    </li>
                                </ul>
                            </div>

                            <!-- Twitter -->
                            <div class="col-md-3 col-sm-6">
                                <h4>Twitter</h4>

                                <div style="position: relative;margin-top: -14px;margin-bottom: -14px;"><a
                                            class="twitter-timeline" href="https://twitter.com/@Themenis2"
                                            data-chrome="noheader nofooter noborders noscrollbar transparent"
                                            data-tweet-limit="2" data-widget-id="407198994117324800" data-theme="light"
                                            data-related="twitterapi,twitter" data-aria-polite="assertive">Tweets
                                        by @Themenis2</a>
                                    <script>!function (d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (!d.getElementById(id)) {
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "../../../../platform.twitter.com/widgets.js";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }
                                        }(document, "script", "twitter-wjs");
                                        window.setTimeout(function () {
                                            $(".twitter-timeline").contents().find(".e-entry-title").css("font-size", "12px");
                                            $(".twitter-timeline").contents().find(".tweet").css("font-size", "12px");
                                            $(".twitter-timeline").contents().find(".p-name").css("font-size", "12px");
                                        }, 1000);</script>
                                </div>
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
                                    <li><a href="#/">About Us</a></li>
                                    <li><a href="#/">Delivery Information</a></li>
                                    <li><a href="#/">Privacy Policy</a></li>
                                    <li><a href="#/">Terms &amp; Conditions</a></li>
                                </ul>
                            </div>

                            <!-- Customer Service -->
                            <div class="col-sm-3 col-xs-6 footer-panel">
                                <h4>Customer Service</h4>
                                <ul>
                                    <li><a href="#/">Contact Us</a></li>
                                    <li><a href="#/">Returns</a></li>
                                    <li><a href="#/">Site Map</a></li>
                                </ul>
                            </div>

                            <!-- Extras -->
                            <div class="col-sm-3 col-xs-6 footer-panel">
                                <h4>Extras</h4>
                                <ul>
                                    <li><a href="#/">Brands</a></li>
                                    <li><a href="#/">Gift Vouchers</a></li>
                                    <li><a href="#/">Affiliates</a></li>
                                    <li><a href="#/">Specials</a></li>
                                </ul>
                            </div>

                            <!-- My Account -->
                            <div class="col-sm-3 col-xs-6 footer-panel">
                                <h4>My Account</h4>
                                <ul>
                                    <li><a href="#/">My Account</a></li>
                                    <li><a href="#/">Order History</a></li>
                                    <li><a href="#/">Wish List</a></li>
                                    <li><a href="#/">Newsletter</a></li>
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
                            <li><img src="{{ URL::asset('/')}}image/catalog/paypal.png" alt=""></li>
                            <li><img src="{{ URL::asset('/')}}image/catalog/mastercard.png" alt=""></li>
                            <li><img src="{{ URL::asset('/')}}image/catalog/visa.png" alt=""></li>
                            <li><img src="{{ URL::asset('/')}}image/catalog/american-express.png" alt=""></li>
                        </ul>
                        <p>Powered By <a href="#/">Neurons-IT</a>. &copy; 2016</p>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('.button-search').click(function () {
            var search = $('#search_query').val();
            var category = $('#cat_search').val();
            window.location = "{{Request::root()}}/search?cat=" + category + "&search=" + search;
        })

		$('.attribute').change(function(){
			if($(this).val() == 'Others'){
				$('#'+$(this).attr('name')+'_text').show();
			}
			else{
				$('#'+$(this).attr('name')+'_text').hide();
			}
		})
    })

</script>

</body>

</html>
