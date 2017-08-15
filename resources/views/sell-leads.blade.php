@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Sell Transactions</div>
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
                            <th class="column-title">Amount Per Item </th>                            <th class="column-title">Shipping Charges </th>
                            <th class="column-title">Buyer Name </th>
                            <th class="column-title">Payment Status </th>
                            <th class="column-title">Mode of Sellling </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($sell as $sells)
                            <tr>
                              <td>{{$sells->payment_id}}</td>
                              <td><a style=color:blue; href="{{Request::root()}}/invoice/{{$sells->invoice_id}}">{{$sells->transaction_id}}</a></td>
                              <td>{{$sells->product_name}}</td>
                              <td>{{$sells->quantity}}</td>
                              <td>{{$sells->amount_paid}}</td>                              <td>{{$sells->shipping_cost}}</td>
                              <td>{{$sells->first_name}}</td>
                              <td>{{$sells->status}}</td>
                              <td>{{$sells->sell_type}}</td>
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
