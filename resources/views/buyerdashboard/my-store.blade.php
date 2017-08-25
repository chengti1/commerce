@extends('layouts.buyerdashboardlayout')
@section('content')
<div class = "box">
    <div class="box-heading">My Products</div>
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content product-grid">
                            <div class="row">
                                @if( isset($products) && $products->count() )
                                    @foreach($products as $product)
                                        <div class="col-sm-3 col-xs-12">
                                            <div class="product clearfix">
                                                <div class="left">
                                                    <div class="image" style="width: 175px; height: 175px;">

                                                        <div class="product-actions">
                                                            <a href = "{{route('product.addToCart', ['id' => $product->product_id])}}" data-original-title="Add to Cart" data-toggle="tooltip">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </a>

                                                            <a data-original-title="Add to compare" data-toggle="tooltip" onclick="compare.add('{{ $product->product_id }}');">
                                                                <i class="fa fa-exchange"></i>
                                                            </a>

                                                            <div class="quickview" data-original-title="Quickview" data-toggle="tooltip">
                                                                <a><i class="fa fa-search"></i></a>
                                                            </div>
                                                        </div>

                                                        <div class="image image-swap-effect">
                                                            <a href="{{URL::asset('/')}}product-detail/{{$product->product_id}}">
                                                            <img alt="{{ $product->product_name }}" src="{{ asset('images/product_master/'.  $product->product_images) }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="right">
                                                    <div class="name" style="width: 129px; height: 35px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        <a href="{{URL::asset('/')}}product-detail/{{$product->product_id}}">
                                                            {{ $product->product_name }}
                                                        </a>
                                                    </div>

                                                    <div class="price">
                                                        <span class="price-old">${{ $product->display_price }}</span>
                                                        <span class="price-new">${{ $product->price_after_discount }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- start pagination -->
                                    <div class="pagination-results">
                                        <div class="col-sm-6 text-left"></div>
                                        <div class="col-sm-6 text-right" id="filter_pagination">
                                        {{ $products->links()}}
                                        </div>
                                    </div>
                                @else
                                    <div class="product-grid" style="display: block;">
                                        <div class="row" style="margin: 100px;">
                                            <div class="col-sm-12 col-xs-12" style="text-align: center;">
                                                <h2>You didn't post any products!</h2>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
