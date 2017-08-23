@extends('layouts.layout')
@section('content')
<div class="pattern">
   <div class="container">
      <div class="row">
         <div class="col-sm-3" id="column_left">
            <div class="box box-category">
               <div class="box-heading">
                  Categories
               </div>
               <div class="strip-line"></div>
               <div class="box-content">
                  <ul class="accordion" id="accordion-category">
                     @foreach($categories as $category)
                     <li class="panel">
                        <a href="{{Request::root()}}/category/{{$category->category_name}}">
                        {{$category->category_name}}</a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-sm-9">
            <div class="full-width" id="slider">
               <div class="background-slider"></div>
               <div class="background">
                  <div class="shadow"></div>
                  <div class="pattern">
                     <div class="container">
                        <div class="camera_wrap" id="camera_wrap_1">
                           <div>
                              <a href="#"><img alt="Slider" src="image/catalog/slider-01.png"></a>
                           </div>
                           <div><img alt="Slider" src="image/catalog/as.jpg"></div>
                        </div>
                     </div>
                     <script type="text/javascript">
                        $(document).ready(function() {
                        
                        var camera_slider = $("#camera_wrap_1");
                        
                        
                        
                        camera_slider.owlCarousel({
                        
                        slideSpeed : 300,
                        
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
            <div class="row">
               <div class="col-sm-12">
                  <div class="row banners hidden-xs">
                     <div class="col-sm-4">
                        <a href="#"><img alt="Image" src="image/catalog/banner-01.png"></a>
                     </div>
                     <div class="col-sm-4">
                        <a href="#"><img alt="Image" src="image/catalog/banner-02.png"></a>
                     </div>
                     <div class="col-sm-4">
                        <a href="#"><img alt="Image" src="image/catalog/banner-03.png"></a>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 col-sm-3" id="column_left">
                        <div class="box">
                           <div class="box-heading">
                              Featured
                           </div>
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
                        <div class="box">
                           <div class="box-heading">
                              Daily Deal
                           </div>
                           <div class="strip-line"></div>
                           <div class="box-content products">
                              <div class="box-product">
                                 <div id="myCarousel15765120">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                       <div class="active item">
                                          <div class="product-grid">
                                             <div class="row">
                                                @foreach($daily as $deal)
                                                <div class="col-sm-4 col-xs-6">
                                                   <!-- Product -->
                                                   <div class="product clearfix">
                                                      <div class="left">
                                                         <div class="image">
                                                            <div class="image image-swap-effect">
                                                               <a href="{{URL::asset('/')}}product-detail/{{$deal->product_id}}">
                                                               <img src="{{URL::asset('/')}}images/product_master/{{$deal->product_images}}" alt="{{$deal->product_name}}">
                                                               </a>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="right">
                                                         <div class="name"><a href="{{URL::asset('/')}}product-detail/{{$deal->product_id}}">{{$deal->product_name}}</a></div>
                                                         <div class="price">
                                                            ${{$deal->price_after_discount}}				
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
                        <div class="box">
                           <a href="#"><img alt="Image" src=
                              "image/catalog/banner-category.png"></a>
                        </div>
                     </div>
                     <div class="col-md-9">
                        <div class="filter-product" id="crousell">
                           <div class="filter-tabs">
                              <div class="bg-filter-tabs">
                                 <div class="bg-filter-tabs2 clearfix">
                                    <ul id="tab1671219">
                                       <li class="active">
                                          <a href="#category-1671219-0">Recently Added</a>
                                       </li>
                                       <li>
                                          <a href="#latest-1671219-1">Recently Viewed</a>
                                       </li>
                                       <li>
                                          <a href="#category-1671219-2">Watchlist</a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-content">
                              <div class="tab-pane active" id="category-1671219-0">
                                 <div class="product-grid">
                                    {{-- */$index=0;/* --}}
                                    @for($j=1; $j<=ceil(count($products)/2); $j++)
                                    <div class="row">
                                       {{-- */$tmpIndex=$index;/* --}}
                                       @for($k=$index;$k<($tmpIndex+4);$k++)
                                       @if($products[$index]['product_name'])
                                       <div class="col-sm-3 col-xs-12">
                                          <!-- Product -->
                                          <div class="product clearfix">
                                             <div class="left">

                                             <!-- edited by kartik. -->
                                                <div class="image" style="width: 175px; height: 175px;">
                                             <!-- end here -->
                                                   <div class="product-actions">
                                                      <a href = "{{route('product.addToCart', ['id' => $products[$index]['product_id'] ])}}" data-original-title="Add to Cart" data-toggle="tooltip"
                                                         ><i class=
                                                         "fa fa-shopping-cart"></i></a> <a data-original-title=
                                                         "Add to compare" data-toggle="tooltip" onclick=
                                                         "compare.add('48');"><i class="fa fa-exchange"></i></a>
                                                      <div class="quickview" data-original-title="Quickview"
                                                         data-toggle="tooltip">
                                                         <a><i class="fa fa-search"></i></a>
                                                      </div>
                                                   </div>
                                                   <div class="image image-swap-effect">
                                                      <a href=
                                                         "{{URL::asset('/')}}product-detail/{{$products[$index]['product_id']}}">
                                                         <!-- Prashant Kumar -->
                                                         <img alt="Canon EOS 5D"  /*style = "height:196px;" */  src=
                                                         "images/product_master/{{$products[$index]['product_images']}}">
                                                         <!-- Prashant Kumar -->
                                                      </a>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="right">

                                             <!-- edited by kartik. -->
                                                <div class="name" style="    width: 129px;
    height: 35px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;">
    <!-- end here -->
                                                   <a href=
                                                      "{{URL::asset('/')}}product-detail/{{$products[$index]['product_id']}}">
                                                   {{$products[$index]['product_name']}}</a>
                                                </div>
                                                <div class="price">
                                                   <span class="price-old">${{$products[$index]['display_price']}}</span> <span class=
                                                      "price-new">${{$products[$index]['price_after_discount']}}</span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       @endif
                                       {{-- */$index++;/* --}}
                                       @endfor
                                    </div>
                                    @endfor
                                 </div>
                                 <div class="row pagination-results">
                                    <div class="col-sm-6 text-left"></div>
                                    <!-- prashant kumar -->										
                                    <div class="col-sm-6 text-right">										   {{ $products->fragment('crousell')->links() }}										</div>
                                    <!-- prashant kumar -->
                                 </div>
                              </div>
                              <div class="tab-pane" id="latest-1671219-1">
                              </div>
                              <div class="tab-pane" id="category-1671219-2">
                              </div>
                           </div>
                        </div>
                     </div>
                     <script type="text/javascript">
                        $('#tab1671219 a').click(function (e) {
                        
                        e.preventDefault();
                        
                        $(this).tab('show');
                        
                        })
                        
                     </script>
                     <div class="row">
                        <div class="col-sm-12"></div>
                     </div>
                  </div>
               </div>
               <div class="row banners hidden-xs" style="padding-top: 15px">
                  <div class="col-sm-6">
                     <a href="#"><img alt="Image" src="image/catalog/banner-04.png"></a>
                  </div>
                  <div class="col-sm-6">
                     <a href="#"><img alt="Image" src="image/catalog/banner-05.png"></a>
                  </div>
               </div>
            </div>
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
@stop