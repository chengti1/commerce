@extends('layouts.buyerdashboardlayout')

@section('content')

    <div class = "box">
        <div class="box-heading">Hunt Requests</div>
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
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">S. No.</th>
                                        <th class="column-title">Product Image</th>
                                        <th class="column-title">Product Name</th>
                                        <th class="column-title">Product price</th>
                                        <th class="column-title">Buyer Status</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($products as $product)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><img width = "100px" height = "100px" src = "{{URL::asset('/')}}images/hunt_seller/{{$product->product_image}}"</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->product_price}}</td>
                                            <td>Paid</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
