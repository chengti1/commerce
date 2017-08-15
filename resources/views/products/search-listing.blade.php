@extends('layouts.layout') 
@section('content')

<div class="pattern">
    <div class="container">
        
    </div>
</div><!-- MAIN CONTENT
================================================== -->
<div class="main-content full-width home">
    <div class="background-content"></div>
    <div class="background">
        <div class="shadow"></div>
        <div class="pattern">
            <div class="container">
                <div class="pattern">
                        <div class="row">
                            <div class="col-sm-3" id="column_left">
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
                        ${{$feature->price_after_discount}}             </div>
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
                        ${{$deal->price_after_discount}}                </div>
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
                            <div class="col-sm-9">
                                <div class="filter-product">
                                    <div class="filter-tabs">
                                        <div class="bg-filter-tabs">
                                            <div class="bg-filter-tabs2 clearfix">
                                                <ul id="tab1671219">
                                                    <li class="active">
                                                        <a href="#category-1671219-0">Buy Products</a>
                                                    </li>
                                                    <li>
                                                        <a href="#latest-1671219-1">Swap Products</a>
                                                    </li>
                                                    <li>
                                                        <a href="#category-1671219-2">Hunt Products</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="category-1671219-0">
                                            <div class="product-grid">
                                                {{-- */$index=0;/* --}}
                                    @for($j=1; $j<=ceil(count($products_sell)/2); $j++)
                                        <div class="row">
                                        {{-- */$tmpIndex=$index;/* --}}
                                            @for($k=$index;$k<($tmpIndex+4);$k++)
                                            @if($products_sell[$index]['product_name'])
                                            <div class="col-sm-3 col-xs-6">
                                                <!-- Product -->
                                                <div class="product clearfix">
                                                    <div class="left">
                                                        <div class="image">
                                                            <div class="product-actions">
                                                                        <a href = "{{route('product.addToCart', ['id' => $products_sell[$index]['product_id'] ])}}" data-original-title="Add to Cart" data-toggle="tooltip"
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
                                                                "{{URL::asset('/')}}product-detail/{{$products_sell[$index]['product_id']}}">
                                                                <img alt="Canon EOS 5D" style = "height:196px;" src=
                                                                "images/product_master/{{$products_sell[$index]['product_images']}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right">
                                                        <div class="name">
                                                            <a href=
                                                            "{{URL::asset('/')}}product-detail/{{$products_sell[$index]['product_id']}}">
                                                            {{$products_sell[$index]['product_name']}}</a>
                                                        </div>
                                                        <div class="price">
                                                            <span class="price-old">${{$products_sell[$index]['display_price']}}</span> <span class=
                                                            "price-new">${{$products_sell[$index]['price_after_discount']}}</span>
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
                                        <div class="col-sm-6 text-right">
                                            {{ $products_sell->links() }}
                                        </div>
                                    </div>
                                        </div>
                                        <div class="tab-pane" id="latest-1671219-1">
                                            <div class="product-grid">
                                                {{-- */$index=0;/* --}}
                                    @for($j=1; $j<=ceil(count($products_swap)/2); $j++)
                                        <div class="row">
                                        {{-- */$tmpIndex=$index;/* --}}
                                            @for($k=$index;$k<($tmpIndex+4);$k++)
                                            @if($products_swap[$index]['product_name'])
                                            <div class="col-sm-3 col-xs-6">
                                                <!-- Product -->
                                                <div class="product clearfix">
                                                    <div class="left">
                                                        <div class="image">
                                                            
                                                            <div class="image image-swap-effect">
                                                                <a href=
                                                                "{{URL::asset('/')}}swap-detail/{{$products_swap[$index]['product_id']}}">
                                                                <img alt="Canon EOS 5D" style = "height:196px;" src=
                                                                "images/product_master/{{$products_swap[$index]['product_images']}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right">
                                                        <div class="name">
                                                            <a href=
                                                            "{{URL::asset('/')}}swap-detail/{{$products_swap[$index]['product_id']}}">
                                                            {{$products_swap[$index]['product_name']}}</a>
                                                        </div>
                                                        <div class="price">
                                                            <span class="price-old">${{$products_swap[$index]['display_price']}}</span> <span class=
                                                            "price-new">${{$products_swap[$index]['price_after_discount']}}</span>
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
                                        <div class="col-sm-6 text-right">
                                            {{ $products_swap->links() }}
                                        </div>
                                    </div>
                                        </div>
                                        <div class="tab-pane" id="category-1671219-2">
                                            <div class="product-grid">
                                                {{-- */$index=0;/* --}}
                                    @for($j=1; $j<=ceil(count($products_hunt)/2); $j++)
                                        <div class="row">
                                        {{-- */$tmpIndex=$index;/* --}}
                                            @for($k=$index;$k<($tmpIndex+4);$k++)
                                            @if($products_hunt[$index]['product_name'])
                                            <div class="col-sm-3 col-xs-6">
                                                <!-- Product -->
                                                <div class="product clearfix">
                                                    <div class="left">
                                                        <div class="image">
                                                            <div class="image image-swap-effect">
                                                                <a href=
                                                                "{{URL::asset('/')}}hunt-detail/{{$products_hunt[$index]['hunt_id']}}">
                                                                <img alt="Canon EOS 5D" style = "height:196px;" src=
                                                                "images/product_hunt/{{$products_hunt[$index]['product_image']}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="right">
                                                        <div class="name">
                                                            <a href=
                                                            "{{URL::asset('/')}}hunt-detail/{{$products_hunt[$index]['product_id']}}">
                                                            {{$products_hunt[$index]['product_name']}}</a>
                                                        </div>
                                                        <div class="price">
                                                             <span class=
                                                            "price-new">${{$products_hunt[$index]['product_price']}}</span>
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
                                        <div class="col-sm-6 text-right">
                                            {{ $products_hunt->links() }}
                                        </div>
                                    </div>
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
