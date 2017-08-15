@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Buy Transactions</div>
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
                            <th class="column-title">Payment Id </th>
                            <th class="column-title">Paypal Transaction Id </th>
                            <th class="column-title">Product Name </th>
                            <th class="column-title">Quantity </th>
                            <th class="column-title">Amount Paid Per Item </th>                            <th class="column-title">Shipping Charges </th>
                            <th class="column-title">Seller Name </th>
                            <th class="column-title">Payment Status </th>
                            <th class="column-title">Mode of Sellling </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($buy as $buys)
                            <tr>
                              <td>{{$buys->payment_id}}</td>
                              <td><a style=color:blue; href="{{Request::root()}}/invoice/{{$buys->invoice_id}}">{{$buys->transaction_id}}</a></td>
                              <td>{{$buys->product_name}}</td>
                              <td>{{$buys->quantity}}</td>
                              <td>{{$buys->amount_paid}}</td>                              <td>{{$buys->shipping_cost}}</td>
                              <td>{{$buys->first_name}}</td>
                              <td>{{$buys->status}}</td>
                              <td>{{$buys->sell_type}}</td>
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
