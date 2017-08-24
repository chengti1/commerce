@extends('layouts/layout')
@section('content')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .tab-new {
            width: 100%;
        }
        .tab-content p {
            margin-top: 15px;
        }
        .breadcrumb .container ul {
            margin-bottom: 15px;
        }
        /*.popup-gallery, .product-center {width:330px;}*/
        .product.clearfix .left {
            width: 30%;
            float: left;
        }
        .product.clearfix .right {
            float: right;
            width: 65%;
        }
        .product.clearfix .right .name {
            padding-top: 0;
        }
    </style>
    <!-- BREADCRUMB ================================================== -->
    <div class="breadcrumb full-width">
        <div class="background-breadcrumb"></div>
        <div class="background">
            <div class="shadow"></div>
            <div class="pattern">
                <div class="container">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="clearfix">
                        <h1 id="title-page">{{$product->product_name}}</h1>
                        <ul>
                            <li><a href="{{Request::root()}}">Home</a></li>
                            <li><a href="{{Request::root()}}/listing">Buy Products</a></li>
                            <li><a href="{{URL::current()}}">{{$product->product_name}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MAIN CONTENT ================================================== -->
    <div class="main-content full-width inner-page">
        <div class="background-content"></div>
        <div class="background">
            <div class="shadow"></div>
            <div class="pattern">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="column_left">
                            <div class="box box-category">
                                <div class="box-heading">Categories</div>
                                <div class="strip-line"></div>
                                <div class="box-content">
                                    <ul class="accordion" id="accordion-category">
                                        @foreach($categories as $category)
                                            <li class="panel">
                                                <a href="{{Request::root()}}/category/{{$category->category_name}}">
                                                    {{$category->category_name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-heading">Featured</div>
                                <div class="strip-line"></div>
                                <div class="box-content products">
                                    <div class="box-product">
                                        <div id="myCarousel15765120">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                                <div class="active item">
                                                    <div class="product-grid">
                                                        <div class="row">
                                                            @foreach($featured as $feature)
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <!-- Product -->
                                                                    <div class="product clearfix">
                                                                        <div class="left">
                                                                            <div class="image">
                                                                                <div class="image image-swap-effect">
                                                                                    <a href="{{URL::asset('/')}}product-detail/{{$feature->product_id}}">
                                                                                        <img src="{{URL::asset('/')}}images/product_master/{{$feature->product_images}}" alt="{{$feature->product_name}}">
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="right">
                                                                            <div class="name">
                                                                                <a href="{{URL::asset('/')}}product-detail/{{$feature->product_id}}">{{$feature->product_name}}</a>
                                                                            </div>
                                                                            <div class="price">
                                                                                ${{$feature->price_after_discount}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <div itemscope itemtype="http://data-vocabulary.org/Product" class="col-sm-9 col-sm-9 col-sm-12 col-xs-12 product-info">
                                    <div class="row" id="quickview_product">
                                        <script>
                                            $(document).ready(function () {
                                                $('#image').elevateZoom({
                                                    zoomWindowFadeIn: 500,
                                                    zoomWindowFadeOut: 500,
                                                    zoomWindowOffetx: 20,
                                                    zoomWindowOffety: -1,
                                                    cursor: "pointer",
                                                    lensFadeIn: 500,
                                                    lensFadeOut: 500,
                                                });
                                                $('.thumbnails a').click(function () {
                                                    var smallImage = $(this).attr('data-image');
                                                    var largeImage = $(this).attr('data-zoom-image');
                                                    var ez = $('#image').data('elevateZoom');
                                                    $('#ex1').attr('href', largeImage);
                                                    ez.swaptheimage(smallImage, largeImage);
                                                    return false;
                                                });
                                            });
                                        </script>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-sx-12 popup-gallery">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!--prahsant changed inline width-->
                                                    <div class="product-image cloud-zoom">
                                                        <!--prahsant changed inline width-->
                                                        <img src="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" id="image" itemprop="image" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_images}}"/>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="thumbnails thumbnails-left clearfix">
                                                            <ul>
                                                                <li>
                                                                    <p>
                                                                        <a href="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_images}}">
                                                                            <img style=" width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" title="{{$product->product_name}}" alt="{{$product->product_name}}">
                                                                        </a>
                                                                    </p>
                                                                </li>
                                                                @if($product->product_image_1 != '')
                                                                    <li>
                                                                        <p>
                                                                            <a href="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}">
                                                                                <img style=" width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}" title="{{$product->product_name}}" alt="{{$product->product_name}}">
                                                                            </a>
                                                                        </p>
                                                                    </li>
                                                                @endif
                                                                @if($product->product_image_2 != '')
                                                                    <li>
                                                                        <p>
                                                                            <a href="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}">
                                                                                <img style=" width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}" title="{{$product->product_name}}" alt="{{$product->product_name}}">
                                                                            </a>
                                                                        </p>
                                                                    </li>
                                                                @endif
                                                                @if($product->product_image_3 != '')
                                                                    <li>
                                                                        <p>
                                                                            <a href="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}">
                                                                                <img style=" width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}" title="{{$product->product_name}}" alt="{{$product->product_name}}">
                                                                            </a>
                                                                        </p>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-sx-12 product-center clearfix">
                                            <div itemprop="offerDetails" itemscope
                                                 itemtype="http://data-vocabulary.org/Offer">
                                                <div class="description">
                                                    <span>Product Code:</span> {{$product->product_id}}
                                                    <br/>
                                                    <span>Availability:</span> In-Stock<br/>
                                                    <span>Status:</span> {{$product->product_status}}<br/>
                                                    <span>Location:</span> {{$product->location}}<br/>
                                                    @foreach($attributes as $item)
                                                        <span>{{$item->attribute_name}}:</span> {{$item->value}}<br/>
                                                    @endforeach
                                                </div>
                                                <div class="price">
                                                    <span class="price-new"><span itemprop="price">${{$product->price_after_discount}}</span></span>
                                                    <br/>
                                                    <br/>
                                                </div>
                                            </div>
                                            <div id="product">
                                                <div class="cart">
                                                    <div class="add-to-cart clearfix">
                                                        <input type="hidden" id="product_qty"
                                                               value="@if(ISSET($products) && ISSET($products[$product->product_id]['qty']))
                                                               {{print_r($products[$product->product_id]['qty'])}}
                                                               @endif"/>
                                                        <input type="button"
                                                               onClick="location.href='{{route('product.addToCart', ['id' => $product->product_id])}}'"
                                                               value="Add to Cart" id="button-cart"
                                                               rel="49" data-loading-text="Loading..."
                                                               class="button"/>
                                                    </div>
                                                    <script type="text/javascript">
                                                        $(document).ready(function () {
                                                            if ($('#product_qty').val() !== '') {
                                                                $('#button-cart').attr('disabled', 'disabled');
                                                                $('#button-cart').attr('value', 'Item added to Cart');
                                                            }
                                                        })
                                                    </script>
                                                    <!--<div class="links">
                                                        <a onclick="wishlist.add('49');"><i
                                                                    class="fa fa-heart"></i> Add to Wish
                                                            List</a>
                                                        <a onclick="compare.add('49');"><i
                                                                    class="fa fa-exchange"></i> Compare
                                                            this Product</a>
                                                    </div>-->
                                                </div>
                                            </div><!-- End #product -->
                                            <div class="review">
                                                <div class="rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a onclick="$('a[href=\'#tab-review\']').trigger('click');">0 reviews</a>
                                                    &nbsp;&nbsp;|&nbsp;&nbsp;
                                                    <a onclick="$('a[href=\'#tab-review\']').trigger('click');">Writea review</a>
                                                </div>
                                            </div>
                                            <div class="social-buttons">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}"
                                                   target="_blank">
                                                    <img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png"
                                                         border="0" alt="Facebook"/>
                                                </a>
                                                <a href="https://twitter.com/intent/tweet?url={{URL::current()}}"
                                                   target="_blank">
                                                    <img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png"
                                                         border="0" alt="Twitter"/>
                                                </a>
                                                <a href="https://plus.google.com/share?url={{URL::current()}}"
                                                   target="_blank">
                                                    <img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png"
                                                         border="0" alt="Google+"/>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <div class="product-block">
                                                <div class="block-content">
                                                    <div style="position: relative;margin: -30px">
                                                        <img src="{{URL::asset('/')}}image/catalog/product-block.png"
                                                             alt="Product block image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- by kartik -->
                                <div id="tabs" class="htabs tab-new">
                                    <a href="#tab-description" id="desp_id_tab">Description</a>
                                    <a href="#tab_2" id="custom_id_tab">Custom Product Tab</a>
                                    <a href="#tab-review" id="review_id_tab">Reviews (0)</a>
                                </div>
                                <div id="review"></div>
                                <div id="tab_2" class="tab-content">
                                    <p>You can add custom product tabs with custom content</p>
                                </div>
                                <div id="tab-description" class="tab-content" itemprop="description">
                                    <p> {!!$product->product_description!!} </p>
                                </div>
                                <!-- <form method="post" enctype="multipart/form-data" action="form-review"> -->
                                <div id="tab-review" class="tab-content">
                                    <!-- hidden fields for get product_id and user_id -->
                                    <input type="hidden" name="hidden_user_id" id="hidden_user_id"
                                           value="{{$userData['user_id']}}">
                                    <input type="hidden" name="hidden_product_id" id="hidden_product_id"
                                           value="{{$product->product_id}}">
                                    <!-- end hidden fields -->
                                    <h2 id="review-title">Write a review</h2>
                                    <b>Your Name</b><br/>
                                    <input type="text" name="name" value="{{$userData['first_name']}}"/>
                                    <br/><br/>
                                    <b>Your Review</b>
                                    <textarea name="text" cols="40" rows="8" style="width: 100%;"
                                              id="textarea-name"></textarea>
                                    <span style="font-size: 11px;"><span class="text-danger">Note:</span> HTML is not translated!</span>
                                    <br/><br/>
                                    <b>Rating</b> <span>Bad</span>&nbsp;
                                    <input type="radio" name="rating" class="radio_class" value="1"/>&nbsp;
                                    <input type="radio" name="rating" class="radio_class" value="2"/>&nbsp;
                                    <input type="radio" name="rating" class="radio_class" value="3"/>&nbsp;
                                    <input type="radio" name="rating" class="radio_class" value="4"/>&nbsp;
                                    <input type="radio" name="rating" class="radio_class" value="5"/>&nbsp;
                                    <span>Good</span><br/><br/>
                                    <b>Enter the code in the box below</b><br/>
                                    <input type="text" name="captcha" id="captcha" placeholder="Please input Captcha"
                                           required>
                                    <div class="refereshrecapcha">
                                        {!! Captcha::img('flat'); !!} <br>
                                    </div>
                                    <a href="javascript:void(0);" onclick="refreshCaptcha()">Refresh</a>
                                    <div class="buttons">
                                        <div class="right">
                                            <!-- <input type="submit" name="continue" id="button-review" class="button right" value="Continue"> -->
                                            <a href="javascript:void(0);" id="button-review" class="button"
                                               onclick="review_conti()">Continue</a>
                                        </div>
                                    </div>
                                </div>
                                <br/><br/>
                                <!-- </form> -->
                                <!-- div for displays all reviews records. -->
                                <div id="displayReviews" class="display_review" style="display: none;">
                                @foreach($reviewList as $list)
                                    @if($product->product_id == $list->product_id)
                                        <!--  product id:{{$list->product_id}} -->
                                            <div class="rating-filp" id="display_row">
                                                <div class="heading-top">
                                                    <span class="hea">{{$list->rating}}<span
                                                                class="star">★</span></span>
                                                <!-- <span class="head-text">{{$list->product_id}}</span> -->
                                                    <span class="head-text">Bubiland Customer</span>
                                                </div>
                                                <p class="comment">{{$list->message}}</p>
                                                <div class="he-foot">
                                                <!-- <span class="name"><b>By</b> {{$list->user_id}}</span> -->
                                                    <span class="certified">Created at: </span>
                                                    <span class="date">{{$list->created_at}}</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <!-- end here -->
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $('select[name="profile_id"], input[name="quantity"]').change(function () {
                            $.ajax({
                                url: 'index.php?route=product/product/getRecurringDescription',
                                type: 'post',
                                data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'profile_id\']'),
                                dataType: 'json',
                                beforeSend: function () {
                                    $('#profile-description').html('');
                                },
                                success: function (json) {
                                    $('.alert, .text-danger').remove();
                                    if (json['success']) {
                                        $('#profile-description').html(json['success']);
                                    }
                                }
                            });
                        });
                    </script>
                    <script type="text/javascript"><!--
                        $('.date').datetimepicker({
                            pickTime: false
                        });
                        $('.datetime').datetimepicker({
                            pickDate: true,
                            pickTime: true
                        });
                        $('.time').datetimepicker({
                            pickDate: false
                        });
                        $('button[id^=\'button-upload\']').on('click', function () {
                            var node = this;
                            $('#form-upload').remove();
                            $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');
                            $('#form-upload input[name=\'file\']').trigger('click');
                            $('#form-upload input[name=\'file\']').on('change', function () {
                                $.ajax({
                                    url: 'index.php?route=product/product/upload',
                                    type: 'post',
                                    dataType: 'json',
                                    data: new FormData($(this).parent()[0]),
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function () {
                                        $(node).find('i').replaceWith('<i class="fa fa-spinner fa-spin"></i>');
                                        $(node).prop('disabled', true);
                                    },
                                    complete: function () {
                                        $(node).find('i').replaceWith('<i class="fa fa-upload"></i>');
                                        $(node).prop('disabled', false);
                                    },
                                    success: function (json) {
                                        if (json['error']) {
                                            $(node).parent().find('input[name^=\'option\']').after('<div class="text-danger">' + json['error'] + '</div>');
                                        }
                                        if (json['success']) {
                                            alert(json['success']);
                                            $(node).parent().find('input[name^=\'option\']').attr('value', json['code']);
                                        }
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                    }
                                });
                            });
                        });
                        //--></script>
                    <script type="text/javascript">
                        $('#review').delegate('.pagination a', 'click', function (e) {
                            e.preventDefault();
                            $('#review').fadeOut('slow');
                            $('#review').load(this.href);
                            $('#review').fadeIn('slow');
                        });
                    </script>
                    <script type="text/javascript"><!--
                        $(document).ready(function () {
                            $('.popup-gallery').magnificPopup({
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
                        //--></script>
                    <script type="text/javascript">
                        $.fn.tabs = function () {
                            var selector = this;
                            this.each(function () {
                                var obj = $(this);
                                $(obj.attr('href')).hide();
                                $(obj).click(function () {
                                    $(selector).removeClass('selected');
                                    $(selector).each(function (i, element) {
                                        $($(element).attr('href')).hide();
                                    });
                                    $(this).addClass('selected');
                                    $($(this).attr('href')).show();
                                    return false;
                                });
                            });
                            $(this).show();
                            $(this).first().click();
                        };
                    </script>
                    <script type="text/javascript">
                        $('#tabs a').tabs();
                    </script>
                    <script type="text/javascript" src="{{URL::asset('/')}}catalog/view/theme/stowear/js/jquery.elevateZoom-3.0.3.min.js"></script>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .display_review {
            height: auto;
            border-bottom: 1px solid #f0f0f0;
        }
        #display_row {
            padding: 0 20px;
            width: 100%;
            height: auto;
            display: inline-block;
        }
        /*.disp_column_1{text-align: center; float: left;}*/
    </style>
    <!-- script for captcha by kartik -->
    <script type="text/javascript">
        function refreshCaptcha() {
            $.ajax({
                url: "{{request::root()}}/refereshcapcha",
                type: "get",
                dataType: "html",
                success: function (json) {
                    $('.refereshrecapcha').html(json);
                }
            });
        }
    </script>
    <!-- end script captcha -->
    <!-- script for show displayReview when click on tab-review -->
    <script>
        $(document).ready(function () {
            $('#custom_id_tab').on('click', function () {
                $('#displayReviews').css("display", "none");
            });
            $('#desp_id_tab').on('click', function () {
                $('#displayReviews').css("display", "none");
            });
            $('#review_id_tab').click(function () {
                $('#displayReviews').css("display", "block");
            });
        });
    </script>
    <!-- script for review by kartik -->
    <script type="text/javascript">
        function review_conti() {
            var hidden_user_id = $('#hidden_user_id').val();
            var hidden_product_id = $('#hidden_product_id').val();
            var textarea_val = $('#textarea-name').val();
            var rating_val = $(".radio_class:checked").val();
            // console.log("Message: "+textarea_val+"user_id: "+hidden_user_id+"product_id: "+hidden_product_id+"rating: "+rating_val);
            $.ajax({
                url: "{{request::root()}}/product-detail",
                type: "get",
                data: {
                    hidden_user_id: hidden_user_id,
                    hidden_product_id: hidden_product_id,
                    textarea: textarea_val,
                    rating: rating_val
                },
                success: function (data) {
                    var spanMessage = "Thank you for your valuable review.";
                    $('#review').addClass('alert alert-success').html(spanMessage);
                }
            });
        }
    </script>
    <!-- end script for review -->
@stop