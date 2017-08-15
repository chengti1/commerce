@extends('layouts.layout')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
        </div>
        <div class="table-responsive cart_info">
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
        	<h1>Your Cart</h1>
            @if(Session::has('cart'))
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="id">Product Id</td>
                        <td class="title">Product Title</td>
                        <td class="price">Price</td>                        <td>Shipping</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="cart_product">
                            <a href="{{URL::asset('/')}}product-detail/{{$product['item']['product_id']}}"><img width = "100px" height = "100px" src="images/product_master/{{$product['item']['product_images']}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <p>Product Id: {{$product['item']['product_id']}} </p>
                        </td>
                        <td class="cart_description">
                            {{$product['item']['product_name']}}
                        </td>
                        <td class="cart_price">
                            <p>${{$product['item']['price_after_discount']}}</p>
                        </td>                        <td class="cart_price">                            <p>$  {{$product['shipping_cost']}}</p>                        </td>
                        <td>
                            <div class="cart_quantity_button">
                                <a href='{{route('product.addToCart', ['id' => $product['item']['product_id']])}}'><i class="fa fa-plus"> </i></a>
                                {{$product['qty']}}
                                <a href="{{route('product.removeFromCart', ['id' => $product['item']['product_id'] ])}}"><i class="fa fa-minus"> </i></a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$product['price']+$product['shipping_cost']}}</p>
                        </td>
                        <td class="cart_delete">
                            <a href="{{route('product.removeCartItem', ['id' => $product['item']['product_id'] ])}}" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h2>Total Quantity : {{$totalqty}}</h2><br>
            <h2>Total Price : ${{$totalprice}}</h2>
            <div class = "row">
            	<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            		<button type="button" onClick = "location.href = '{{Request::root()}}/payment'" class = "btn btn-success">Proceed to Checkout</button>
            		<button type="button" onClick = "location.href = '{{Request::root()}}/listing'" class = "btn btn-success">Continue Shopping</button>
                    <button type="button" onClick = "location.href = '{{Request::root()}}/empty-cart'" class = "btn btn-success">Empty Cart</button>
            	<div>
            </div><br>
        </div>
    </div>
</section>
@else
	<h1> No items in your Cart</h1>

@endif <!--/#cart_items-->
@stop
