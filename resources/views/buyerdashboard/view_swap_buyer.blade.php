@extends('layouts.layout')

@section('content')
    <!-- BREADCRUMB
	================================================== -->
    <div class="breadcrumb full-width">
        <div class="background-breadcrumb"></div>
        <div class="background">
            <div class="shadow"></div>
            <div class="pattern">
                <div class="container">
                    <div class="clearfix">
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
                        <h1 id="title-page">    {{$products->product_name}}                                    </h1>

                        <ul>
                            <li><a href="{{Request::root()}}/">Home</a></li>
                            <li><a href="{{Request::root()}}/hunt-listing">Hunt Items</a></li>
                            <li><a href="{{URL::current()}}">{{$products->product_name}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT
        ================================================== -->
    <div class="main-content full-width inner-page">
        <div class="background-content"></div>
        <div class="background">
            <div class="shadow"></div>
            <div class="pattern">
                <div class="container">


                    <div class="row">

                        <div class="col-sm-3" id="column_left">
                           

                            
                        </div>

                        <div class="col-sm-9">


                            <div class="row">
                                <div class="col-sm-12 center-column">


                                    <div itemscope itemtype="http://data-vocabulary.org/Product">
                                        <span itemprop="name" class="hidden">Samsung Galaxy Tab 10.1</span>
                                        <div class="product-info">
                                            <div class="row">
                                                <div class="col-sm-9">
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
                                                        <div class="col-sm-6 popup-gallery">
                                                            <div class="row">


                                                                <div class="col-sm-12">
                                                                    <div class="product-image cloud-zoom" style = "height:465px; width:308px;">

                                                                        <img style = "height:465px; width:308px;" src="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image}}" title="{{$products->product_name}}" alt="{{$products->product_name}}" id="image" itemprop="image" data-zoom-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image}}">
                                                                    </div>

                                                                    <div class="col-sm-12">
                                                                        <div class="thumbnails thumbnails-left clearfix">
                                                                            <ul>
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image}}" data-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image}}" data-zoom-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image}}" title="{{$products->product_name}}" alt="{{$products->product_name}}"></a></p></li>
                                                                                @if($products->product_image_1 != '')
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_1}}" data-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_1}}" data-zoom-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_1}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_1}}" title="{{$products->product_name}}" alt="{{$products->product_name}}"></a></p></li>
                                                                                @endif

                                                                                @if($products->product_image_2 != '')
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_2}}" data-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_2}}" data-zoom-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_2}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_2}}" title="{{$products->product_name}}" alt="{{$products->product_name}}"></a></p></li>
                                                                                @endif

                                                                                @if($products->product_image_3 != '')
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_3}}" data-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_3}}" data-zoom-image="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_3}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_swap_request/{{$products->product_image_3}}" title="{{$products->product_name}}" alt="{{$products->product_name}}"></a></p></li>
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 product-center clearfix">
                                                            <div itemprop="offerDetails" itemscope
                                                                 itemtype="http://data-vocabulary.org/Offer">
                                                                <div class="description">
                                                                    <span>Product Code:</span> {{$products->hunt_id}}
                                                                    <br/>
                                                                    <span>Reward Points:</span> 1000<br/>
                                                                    <span>Availability:</span> Pre-Order
                                                                </div>
                                                                <div class="price">
                                                                    <span class="price-new"><span
                                                                                itemprop="price">${{$products->product_price}}</span></span>
                                                                    <br/>
                                                                    <br/>
                                                                </div>
                                                            </div>

                                                            <div id="product">


                                                                <div class="cart">
                                                                    <div class="add-to-cart clearfix">

                                                                        
                                                                        @if($products->status == 0)
                              <button onClick="location.href = '{{Request::root()}}/payment-swaps/{{$products->swap_id}}';" type="button" class="btn btn-danger">Confirm</button>
                              @else
                              Confirmed
                              @endif
                                                                        </a>
                                                                                                                                            </div>

                                                                    <div class="links">
                                                                        <a onclick="wishlist.add('49');"><i
                                                                                    class="fa fa-heart"></i> Add to Wish
                                                                            List</a>
                                                                        <a onclick="compare.add('49');"><i
                                                                                    class="fa fa-exchange"></i> Compare
                                                                            this Product</a>
                                                                    </div>

                                                                </div>
                                                            </div><!-- End #product -->
                                                            <div class="review">
                                                                <div class="rating"><i class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i><i
                                                                            class="fa fa-star"></i>&nbsp;&nbsp;&nbsp;<a
                                                                            onclick="$('a[href=\'#tab-review\']').trigger('click');">0
                                                                        reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                                                                            onclick="$('a[href=\'#tab-review\']').trigger('click');">Write
                                                                        a review</a></div>
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
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
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
                                        <div id="tabs" class="htabs">
                                            <a href="#tab-description">Description</a><a href="#tab_2">Custom Product
                                                Tab</a><a href="#tab-review">Reviews (0)</a></div>
                                        <div id="tab_2" class="tab-content"><p>You can add custom product tabs with
                                                custom content</p>
                                        </div>
                                        <div id="tab-description" class="tab-content" itemprop="description"><p>
                                            {!!$products->product_description!!}
                                        </div>
                                        <div id="tab-review" class="tab-content">
                                            <div id="review"></div>
                                            <h2 id="review-title">Write a review</h2>
                                            <b>Your Name</b><br/>
                                            <input type="text" name="name" value=""/>
                                            <br/>
                                            <br/>
                                            <b>Your Review</b>
                                            <textarea name="text" cols="40" rows="8" style="width: 100%;"></textarea>
                                            <span style="font-size: 11px;"><span class="text-danger">Note:</span> HTML is not translated!</span><br/>
                                            <br/>
                                            <b>Ratng</b> <span>Bad</span>&nbsp;
                                            <input type="radio" name="rating" value="1"/>
                                            &nbsp;
                                            <input type="radio" name="rating" value="2"/>
                                            &nbsp;
                                            <input type="radio" name="rating" value="3"/>
                                            &nbsp;
                                            <input type="radio" name="rating" value="4"/>
                                            &nbsp;
                                            <input type="radio" name="rating" value="5"/>
                                            &nbsp;<span>Good</span><br/>
                                            <br/>
                                            <b>Enter the code in the box below</b><br/>
                                            <input type="text" name="captcha" value=""/>
                                            <br/>
                                            <img src="indexffc1.jpg?route=product/product/captcha" alt="" id="captcha"/><br/>
                                            <br/>
                                            <div class="buttons">
                                                <div class="right"><a id="button-review" class="button">Continue</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script type="text/javascript">

                                        $(document).ready(function () {
                                            var loggedinname = $('#loggedinname').text();
                                            if (loggedinname == "Login") {
                                                $('#info-button').attr("data-target", "#loginModal");
                                            }
                                            else {
                                                $('#info-button').attr("data-target", "#myModal");
                                            }
                                        })

                                    </script>

                                    <script type="text/javascript"><!--
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
                                        //--></script>

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
                                        //-->
                                    </script>


                                    <script type="text/javascript"><
                                        !--
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

                                    <script type="text/javascript"><!--
                                        $('#tabs a').tabs();
                                        //--></script>

                                    <script type="text/javascript"
                                            src="{{URL::asset('/')}}catalog/view/theme/stowear/js/jquery.elevateZoom-3.0.3.min.js"></script>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop