	@extends('layouts.layout') @section('content') 



	<!-- BREADCRUMB

    ================================================== -->

	<div class="breadcrumb full-width">

		<div class="background-breadcrumb"></div>

		<div class="background">

			<div class="shadow"></div>

			<div class="pattern">

				<div class="container">

					<div class="clearfix">

						<h1 id="title-page">Buy Products</h1>

						<ul>

							<li>

								<a href="{{Request::root()}}">Home</a>

							</li>

							

							<li>

								<a href="{{URL::current()}}">Buy Products</a>

							</li>

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

						@if(count($categories) != 0)

							<div class="box box-category">



								<div class="box-heading">

									Categories

								</div>

								<div class="strip-line"></div>

						<!-- edited by kartik -->
								<div class="box-content">
									<ul class="accordion" id="accordion-category">
									
									@foreach($categories as $cat_values)
									<input type="hidden" name="hide_category_name" id="hidden_name" value="{{$cat_values['category_name']}}">
										<li class="panel">
											<a href="{{Request::root()}}/category/{{$cat_values['category_name']}}">
												{{$cat_values['category_name']}}
											</a>
										</li>
										@foreach($subCategories as $subCat_values)
										
											@if($subCat_values['parent_id'] == $cat_values['category_id'])
												<ul>
												<input type="hidden" name="hide_subcategory_name" id="hidden_sub_name" value="{{$subCat_values['category_name']}}">
													<li>
														<a href = "{{Request::root()}}/subcategory/{{$subCat_values['category_name']}}">
														{{$subCat_values['category_name']}}
														</a>
													</li>
												</ul>
											@endif
										@endforeach
										
									@endforeach
									</ul>
								</div>
						<!-- end here -->

							</div>

							@endif

							<div class="box">

								<div class="box-heading">

									Refine Search

								</div>

								<div class="strip-line"></div>

								<div class="box-content" id="filter">

									<ul class="box-filter">

<!-- <li>
<span id="filter-group1">Shop by color</span>
<ul>
	<li><input id="filter1" type="checkbox" value="1"> 
	<label for="filter1">Black</label></li>
	<li><input id="filter2" type="checkbox" value="2"> 
	<label for="filter2">Red</label></li>
	<li><input id="filter3" type="checkbox" value="3"> 
	<label for="filter3">White</label></li>
	<li><input id="filter4" type="checkbox" value="4"> 
	<label for="filter4">Yellow</label></li>
</ul>
</li> -->

										<li>

											<span id="filter-group2">Shop by price</span>

											<ul>

												<li><input name="price" <?= (ISSET($_GET['filter']) && $_GET['filter']=='5')?'checked="checked"':'' ?> id="filter5" type="radio" value="5"> <label for="filter5">$0 - $99</label></li>

												<li><input name="price" <?= (ISSET($_GET['filter']) && $_GET['filter']=='6')?'checked="checked"':'' ?> id="filter6" type="radio" value="6"> <label for="filter6">$100 - $199</label></li>

												<li><input name="price" <?= (ISSET($_GET['filter']) && $_GET['filter']=='7')?'checked="checked"':'' ?> id="filter7" type="radio" value="7"> <label for="filter7">$200 - $399</label></li>

												<li><input name="price" <?= (ISSET($_GET['filter']) && $_GET['filter']=='8')?'checked="checked"':'' ?> id="filter8" type="radio" value="8"> <label for="filter8">$400 - $999</label></li>

												<li><input name="price" <?= (ISSET($_GET['filter']) && $_GET['filter']=='9')?'checked="checked"':'' ?> id="filter9" type="radio" value="9"> <label for="filter8">$999 and Above</label></li>

											</ul>

										</li>

									</ul><a class="button" id="button-filter">Refine Search</a>

								</div>

							</div>

							

							<div class="row banners hidden-xs" style="margin-top: 20px">

								<div class="col-sm-12">

									<a href="#"><img alt="Image" src=

									"{{URL::asset('/')}}image/catalog/banner-category.png"></a>

								</div>

							</div>

						</div>

						<div class="col-sm-9">

							<div class="row">

								<div class="col-sm-12 center-column">

									<div class="category-info clearfix">

										<div class="image"><img alt="Girls" src=

										"http://themenis.com/opencart/stowear/v1/image/cache/catalog/women-870x261.png"></div>

									</div><!-- Filter -->

									<div class="product-filter clearfix">

<!-- <div class="options">
	<div class="product-compare">
		<a href="#" id="compare-total">Product Compare (0)</a>
	</div>
	<div class="button-group display" data-toggle="buttons-radio">
		<button class="active" id="grid" onclick="display('grid');" rel= "tooltip" title="Grid">
		<i class="fa fa-th-large"></i></button>
		<button id="list" onclick="display('list');" rel="tooltip" title= "List"></button>
	</div>
</div> -->

										<div class="list-options">

											<div class="sort">

												Sort By: <select id="sort">

													<option value="">Default</option>

													<option <?= (ISSET($_GET['sort']) && $_GET['sort']=='1')?'selected':'' ?> value="1">Name (A - Z)</option>

													<option <?= (ISSET($_GET['sort']) && $_GET['sort']=='2')?'selected':'' ?> value="2">Name (Z - A)</option>

													<option <?= (ISSET($_GET['sort']) && $_GET['sort']=='3')?'selected':'' ?> value="3">Price (Low &gt; High)</option>

													<option <?= (ISSET($_GET['sort']) && $_GET['sort']=='4')?'selected':'' ?> value="4">Price (High &gt; Low)</option>

													<option <?= (ISSET($_GET['sort']) && $_GET['sort']=='5')?'selected':'' ?> value="5">Rating (Highest)</option>

													<option <?= (ISSET($_GET['sort']) && $_GET['sort']=='6')?'selected':'' ?> value="6">Rating (Lowest)</option>

												</select>

											</div>

											<div class="limit">

												Show: <select id="pagination">

													<option <?= (ISSET($_GET['pagination']) && $_GET['pagination']=='15')?'selected':'' ?> value="15">15</option>

													<option <?= (ISSET($_GET['pagination']) && $_GET['pagination']=='25')?'selected':'' ?> value="25">25</option>

													<option <?= (ISSET($_GET['pagination']) && $_GET['pagination']=='50')?'selected':'' ?> value="50">50</option>

													<option <?= (ISSET($_GET['pagination']) && $_GET['pagination']=='75')?'selected':'' ?> value="75">75</option>

													<option <?= (ISSET($_GET['pagination']) && $_GET['pagination']=='100')?'selected':'' ?> value="100">100</option>

												</select>

											</div>

										</div>

									</div>

									

									<!-- Products grid -->

<!-- edited by kartik -->
<div class="product-grid" style="display: block;">
<div class="row">
@if($filter_data != NULL)
	@foreach($filter_data as $filter_data_values)
	<div class="col-sm-3 col-xs-6">
		<div class="product clearfix">
			<div class="left">
				<div class="image" style="width: 196px; height: 196px;">

					<div class="product-actions">
						<a href = "{{route('product.addToCart', ['id' => $filter_data_values->product_id])}}" data-original-title="Add to Cart" data-toggle="tooltip">
						<i class="fa fa-shopping-cart"></i>
						</a>

						<a data-original-title="Add to compare" data-toggle="tooltip" 
						onclick="compare.add('48');"><i class="fa fa-exchange"></i>
						</a>
						
						<div class="quickview" data-original-title="Quickview" data-toggle="tooltip">
							<a><i class="fa fa-search"></i></a>
						</div>
					</div>

					<div class="image image-swap-effect">
						<a href="{{URL::asset('/')}}product-detail/{{$filter_data_values->product_id}}">
						<img alt="Canon EOS 5D" style = "height:160px; width:170px;"
						src="{{request::root()}}/images/product_master/{{$filter_data_values->product_images}}">
						</a>
					</div>

				</div>
			</div>

			<div class="right">
				<div class="name" style="width: 129px; height: 35px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
					<a href="{{URL::asset('/')}}product-detail/{{$filter_data_values->product_id}}">
						{{$filter_data_values->product_name}}
					</a>
				</div>

				<div class="price">
					<span class="price-old">${{$filter_data_values->display_price}}</span> 
					<span class="price-new">${{$filter_data_values->price_after_discount}}</span>
				</div>
			</div>

		</div> 
	</div>
		@endforeach
</div>
@else
<div class="product-grid" style="display: block;">
	<div class="row" style="margin: 100px;">
		<div class="col-sm-12 col-xs-12" style="text-align: center;">
			<h2>no records are found on selected range, Please Try Again!</h2>
		</div>
	</div>
</div>
@endif
</div>

<div class="row pagination-results">
	<div class="col-sm-6 text-left"></div>
	<div class="col-sm-6 text-right">

	@if(isset($_GET['pagination']))
		{{ $filter_data->appends(['pagination' => $_GET['pagination'],'sort'=>$_GET['sort'],'filter'=>$_GET['filter']])->links() }}
	@else
		{{$filter_data->links()}}
	@endif
</div>
</div>
<!-- END HERE -->

<script type="text/javascript">
function display(view) {
	if (view == 'list') {
	$('.product-grid').css("display", "none");
	$('.product-list').css("display", "block");
	$.cookie('display', 'list'); 
	} else {
	$('.product-grid').css("display", "block");
	$('.product-list').css("display", "none");
	$.cookie('display', 'grid');
	}
	}
	view = $.cookie('display');
	if (view) {
	display(view);
}
</script>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12"></div>

					</div>

				</div>

			</div>

		</div>
	<!-- edited by kartik -->
	<script type="text/javascript">
		$('#sort').change(function(){
			var hidden_name = $('hidden_name').val();
			var sort = $('#sort').val();
			var pagination = $('#pagination').val();
			var filter = "";
			$('#filter').find('input[type="radio"]').each(function(){
				if($(this).is(':checked')){
					filter = $(this).val();
				}
			})
			window.location.href="{{request::root()}}/subcategory/"+hidden_name+"?pagination="+pagination+"&sort="+sort+"&filter="+filter;
		})
		$('#pagination').change(function(){
			var hidden_name = $('hidden_name').val();
			var sort = $('#sort').val();
			var pagination = $('#pagination').val();
			var filter = "";
			$('#filter').find('input[type="radio"]').each(function(){
				if($(this).is(':checked')){
					filter = $(this).val();
				}
			})
			// $('.pagination-results').css('display','none');
			window.location.href="{{request::root()}}/subcategory/"+hidden_name+"?pagination="+pagination+"&sort="+sort+"&filter="+filter;
		})
		$('#button-filter').click(function(){
			var hidden_name = $('hidden_name').val();
			var sort = $('#sort').val();
			var pagination = $('#pagination').val();
			var filter = "";
			$('#filter').find('input[type="radio"]').each(function(){
				if($(this).is(':checked')){
					filter = $(this).val();
				}
			})
			window.location.href="{{request::root()}}/subcategory/"+hidden_name+"?pagination="+pagination+"&sort="+sort+"&filter="+filter;
		})
	</script>
	</div>@stop