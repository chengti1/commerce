@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Payment Methods</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button onClick = "location.href='{{Request::root()}}/buyerdashboard/addpmethod'" type="button" class="btn btn-primary">Add</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Payment Method Id </th>
                            <th class="column-title">Payment Method Name </th>
                            <th class="column-title">Delete </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($payments as $payment)
                            <tr>
                              <td>{{$payment->payment_method_id}}</td>
                              <td>{{$payment->payment_method}}</td>
                              <td><button onClick="location.href = '{{Request::root()}}/buyerdashboard/deletepmethod?id={{$payment->payment_method_id}}&sellerid={{$payment->seller_id}}';" type="button" class="btn btn-danger">Delete</button></td>
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