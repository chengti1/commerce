@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Swap Requests</div>
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
                            <th class="column-title">Product Id </th>
                            <th class="column-title">Product Name </th>
                            <th class="column-title">Product Image </th>
                            <th class="column-title">Product Description </th>
                            <th class="column-title">Product Price </th>
                            <th class="column-title">For Swap Id </th>
                            <th class="column-title">For Swap Product Name </th>
                            <th class="column-title">Confirm </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($swap_request as $swap_requests)
                            <tr>
                              <td>{{$swap_requests->old_product_id}}</td>
                              <td>{{$swap_requests->old_product_name}}</td>
                              <td><img width = "100px" height = "100px" src = "{{URL::asset('/')}}images/product_master/{{$swap_requests->old_product_images}}"</td>
                              <td>{{$swap_requests->old_product_description}}</td>
                              <td>${{$swap_requests->old_price_after_discount}}</td>
                              <td>{{$swap_requests->swap_id}}</td>
                              <td>{{$swap_requests->product_name}}</td>
                              <td>
                              @if($swap_requests->buyer_paid == 0)
                              <button onClick="location.href = '{{Request::root()}}/payment-swapb/{{$swap_requests->swap_id}}';" type="button" class="btn btn-danger">Pay</button>
                              @else
                              Paid
                              @endif
                              </td>
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
