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
					<h1 id="title-page">	{{$product->product_name}}									</h1>

					<ul>
												<li><a href="{{Request::root()}}">Home</a></li>
												<li><a href="{{Request::root()}}/swap-listing">Swap Items</a></li>
												<li><a href="{{URL::current()}}">{{$product->product_name}}</a></li>
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
						<div class="box box-category">
  <div class="box-heading">Categories</div>
  <div class="strip-line"></div>
  <div class="box-content">
    <ul class="accordion" id="accordion-category">
							@foreach($categories as $category)
							<li class="panel">
								<a href=
								"{{Request::root()}}/category/{{$category->category_id}}">
								{{$category->category_name}}</a>
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
    				    			<div class="active item"><div class="product-grid"><div class="row">

 @foreach($featured as $feature)
 <div class="col-sm-4 col-xs-6">

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
		<div class="name"><a href="{{URL::asset('/')}}product-detail/{{$feature->product_id}}">{{$feature->product_name}}</a></div>


		<div class="price">
						${{$feature->price_after_discount}}				</div>
	</div>
</div>
</div>
@endforeach
    			    			</div></div></div>    		</div>

    				</div>
    </div>
  </div>
</div>
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
			    	$(document).ready(function(){
			    						    		$('#image').elevateZoom({
								zoomWindowFadeIn: 500,
								zoomWindowFadeOut: 500,
								zoomWindowOffetx: 20,
								zoomWindowOffety: -1,
								cursor: "pointer",
								lensFadeIn: 500,
								lensFadeOut: 500,
				    		});

			    		$('.thumbnails a').click(function() {
			    			var smallImage = $(this).attr('data-image');
			    			var largeImage = $(this).attr('data-zoom-image');
			    			var ez =   $('#image').data('elevateZoom');
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

					     	 <img style = "height:465px; width:308px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" title="Samsung Galaxy Tab 10.1" alt="Samsung Galaxy Tab 10.1" id="image" itemprop="image" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" />
					      </div>

                          <div class="col-sm-12">
                                                                        <div class="col-sm-12">
                                                                        <div class="thumbnails thumbnails-left clearfix">
                                                                            <ul>
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_images}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_images}}" title="{{$product->product_name}}" alt="{{$product->product_name}}"></a></p></li>

                                                                                @if($product->product_image_1 != '')
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_image_1}}" title="{{$product->product_name}}" alt="{{$product->product_name}}"></a></p></li>
                                                                                @endif

                                                                                @if($product->product_image_2 != '')
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_image_2}}" title="{{$product->product_name}}" alt="{{$product->product_name}}"></a></p></li>
                                                                                @endif

                                                                                @if($product->product_image_3 != '')
                                                                                <li><p><a href="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}" data-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}" data-zoom-image="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}"><img style = "height:67px; width:45px;" src="{{URL::asset('/')}}images/product_master/{{$product->product_image_3}}" title="{{$product->product_name}}" alt="{{$product->product_name}}"></a></p></li>
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    </div>
					  	 				      </div>

				      			      </div>
			    </div>

			    <div class="col-sm-6 product-center clearfix">
			     <div itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
						 <div class="description">

 								<span>Product Code:</span> {{$product->product_id}}

 								<br/>
 								<span>Status:</span> {{$product->product_status}}<br/>
 								<span>Location:</span> {{$product->location}}<br/>
 								@foreach($attributes as $item)
 									<span>{{$item->attribute_name}}:</span> {{$item->value}}<br/>
 								@endforeach


 						</div>
			      			      <div class="price">
			        			        <span class="price-new"><span itemprop="price">${{$product->price_after_discount}}</span></span>
			        			        <br />
			        			        <br />
			        			        			        			      </div>
			      			     </div>

			     <div id="product">


			      <div class="cart">
			        <div class="add-to-cart clearfix">

			          <input type="button" id = "info-button" class="btn btn-info btn-lg" data-toggle="modal" value = "Swap Product" />
			        </div>
			        <div class="modal fade" id="myModal" role="dialog">
			        <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Swap Product Details</h4>
        </div>
        <div class="modal-body">
          <form id="swap-form" name="test123" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Image
                        </label> <a id = "show_optional">Add more images</a>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::file('image') !!}
                        </div>
                      </div>
                      <div id = "optional_images">
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Image 1</label>
                                                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                        {!! Form::file('image1') !!}
                                                                                                        @if($errors->has('image1'))
                                                                                                            <div class="alert alert-danger">
                                                                                                                {{$errors->first('image1')}}
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Image 2</label>
                                                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                        {!! Form::file('image2') !!}
                                                                                                        @if($errors->has('image2'))
                                                                                                            <div class="alert alert-danger">
                                                                                                                {{$errors->first('image2')}}
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Image 3</label>
                                                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                                        {!! Form::file('image3') !!}
                                                                                                        @if($errors->has('image3'))
                                                                                                            <div class="alert alert-danger">
                                                                                                                {{$errors->first('image3')}}
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type = "text" name = "productname" id = "productname" class = "form-control col-md-7 col-xs-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Price
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type = "text" name = "price" id = "price" class = "form-control col-md-7 col-xs-12" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" name = "description" class="form-control col-md-7 col-xs-12 ckeditor"  required></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>


        </div>
        <div class="modal-footer">
          <button type="button" id = "close" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id = "swapconfirm" class="btn btn-default">Confirm</button>
        </div>
        </form>
      </div>
      </div>
    </div>
    <div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Login to Continue</h4>
        </div>
        <div class="modal-body">
        <form action="{{Request::root()}}/login" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
          <label class="control-label" for="input-email">E-Mail Address</label>
          <input type="email" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" required/>
        </div>
        <div class="form-group" style="padding-bottom: 10px">
          <label class="control-label" for="input-password">Password</label>
          <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" required/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onClick = "location.href='{{Request::root()}}/register'">Register</button>
          <button type="submit" id = "login" class="btn btn-default">Login</button>
        </div>
        </form>
      </div>

    </div>
  </div>

			        <div class="links">
			        	<a onclick="wishlist.add('49');"><i class="fa fa-heart"></i> Add to Wish List</a>
			        	<a onclick="compare.add('49');"><i class="fa fa-exchange"></i> Compare this Product</a>
			        </div>

			        			      </div>
			     </div><!-- End #product -->
			      			      <div class="review">
			      				        <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');">0 reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');">Write a review</a></div>
			        			      </div>
			        			      <div class="social-buttons">
										<a href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}"
										   target="_blank">
										   <img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/>
										</a>
										<a href="https://twitter.com/intent/tweet?url={{URL::current()}}"
								       target="_blank">
								        <img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/>
								    </a>
								    <a href="https://plus.google.com/share?url={{URL::current()}}"
								       target="_blank">
								       <img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/>
								    </a>
									  </div>
			      		    	</div>
		    </div>
    	</div>

    	    	<div class="col-sm-3">
    		<div class="product-block">
    			    			<div class="block-content">
    				<div style="position: relative;margin: -30px">
 <img src="{{URL::asset('/')}}image/catalog/product-block.png" alt="Product block image">
</div>    			</div>
    		</div>
    	</div>
    	    </div>
  </div>
    <div id="tabs" class="htabs">
  	<a href="#tab-description">Description</a><a href="#tab_2">Custom Product Tab</a><a href="#tab-review"></a>  </div>
  <div id="tab_2" class="tab-content"><p>You can add custom product tabs with custom content</p>
</div>  <div id="tab-description" class="tab-content" itemprop="description"><p>
	{!!$product->product_description!!}
</div>
      <div id="tab-review" class="tab-content">
    <div id="review"></div>
    <h2 id="review-title">Write a review</h2>
    <b>Your Name</b><br />
    <input type="text" name="name" value="" />
    <br />
    <br />
    <b>Your Review</b>
    <textarea name="text" cols="40" rows="8" style="width: 100%;"></textarea>
    <span style="font-size: 11px;"><span class="text-danger">Note:</span> HTML is not translated!</span><br />
    <br />
    <b>Ratng</b> <span>Bad</span>&nbsp;
    <input type="radio" name="rating" value="1" />
    &nbsp;
    <input type="radio" name="rating" value="2" />
    &nbsp;
    <input type="radio" name="rating" value="3" />
    &nbsp;
    <input type="radio" name="rating" value="4" />
    &nbsp;
    <input type="radio" name="rating" value="5" />
    &nbsp;<span>Good</span><br />
    <br />
    <b>Enter the code in the box below</b><br />
    <input type="text" name="captcha" value="" />
    <br />
    {!! Captcha::img(); !!}<br />
    <br />
    <div class="buttons">
      <div class="right"><a id="button-review" class="button">Continue</a></div>
    </div>
  </div>
      </div>

      <script type="text/javascript">

	$(document).ready(function(){
		var loggedinname = $('#loggedinname').text();
		if(loggedinname == "Login"){
			$('#info-button').attr("data-target", "#loginModal");
		}
		else{
			$('#info-button').attr("data-target", "#myModal");
		}
	})

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('form#swap-form').submit(function(){
			event.preventDefault();
			jQuery("#description").val(CKEDITOR.instances.description.getData());
      var formData = new FormData($(this)[0]);

			$.ajax({
				url : '{{URL::asset('/')}}buyerdashboard/swapconfirmbuyer/{{$product->product_id}}',
				type : 'post',
				data : formData,
				async: false,
    			cache: false,
    			contentType: false,
    			processData: false,
				success : function(result){
					alert(result);
				}
			})
			$('#close').click();
		})
	})
</script>

<script type="text/javascript"><!--
$('select[name="profile_id"], input[name="quantity"]').change(function(){
	$.ajax({
		url: 'index.php?route=product/product/getRecurringDescription',
		type: 'post',
		data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'profile_id\']'),
		dataType: 'json',
		beforeSend: function() {
			$('#profile-description').html('');
		},
		success: function(json) {
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

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	$('#form-upload input[name=\'file\']').on('change', function() {
		$.ajax({
			url: 'index.php?route=product/product/upload',
			type: 'post',
			dataType: 'json',
			data: new FormData($(this).parent()[0]),
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				$(node).find('i').replaceWith('<i class="fa fa-spinner fa-spin"></i>');
				$(node).prop('disabled', true);
			},
			complete: function() {
				$(node).find('i').replaceWith('<i class="fa fa-upload"></i>');
				$(node).prop('disabled', false);
			},
			success: function(json) {
				if (json['error']) {
					$(node).parent().find('input[name^=\'option\']').after('<div class="text-danger">' + json['error'] + '</div>');
				}

				if (json['success']) {
					alert(json['success']);

					$(node).parent().find('input[name^=\'option\']').attr('value', json['code']);
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});
});
//--></script>
<script type="text/javascript"><!--
$('#review').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();

    $('#review').fadeOut('slow');

    $('#review').load(this.href);

    $('#review').fadeIn('slow');
});

</script>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('.popup-gallery').magnificPopup({
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
//--></script>

<script type="text/javascript">
$.fn.tabs = function() {
	var selector = this;

	this.each(function() {
		var obj = $(this);

		$(obj.attr('href')).hide();

		$(obj).click(function() {
			$(selector).removeClass('selected');

			$(selector).each(function(i, element) {
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

<script type="text/javascript" src="{{URL::asset('/')}}catalog/view/theme/stowear/js/jquery.elevateZoom-3.0.3.min.js"></script>
							</div>

													</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
											</div>
				</div>
			</div>
			<script>
                                        $(document).ready(function(){
                                            $('#optional_images').hide();
                                            $('#show_optional').click(function(){
                                                $('#optional_images').show();
                                                $('#show_optional').attr('id', 'hide_optional');
                                            });
                                        });
                                    </script>
		</div>
	</div>
</div>

@stop
