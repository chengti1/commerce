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
                                        <th class="column-title">Product Image</th>
                                        <th class="column-title">Product Name</th>
                                        <th class="column-title">View Requests</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><img width = "100px" height = "100px" src = "{{URL::asset('/')}}images/product_hunt/{{$product->product_image}}"</td>
                                            <td>{{$product->product_name}}</td>
                                            <td><button class = "btn btn-success" onClick = "location.href = '{{Request::root()}}/buyerdashboard/view-hunt/{{$product->hunt_id}}'">View</button></td>
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