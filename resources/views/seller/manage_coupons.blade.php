@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
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
       <div class="box-heading">Manage Coupons</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button onClick = "location.href='{{Request::root()}}/buyerdashboard/add-coupon'" type="button" class="btn btn-primary">Add</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Coupon ID</th>
                            <th class="column-title">Coupon Title</th>
                            <th class="column-title">Coupon Code</th>
                            <th class="column-title">Start Date</th>
                            <th class="column-title">End Date</th>
                            <th class="column-title">Discount</th>
                            <th class="column-title">Update</th>
                            <th class="column-title">Manage Rules</th>
                            <th class="column-title">Delete</th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($coupons as $coupon)
                            <tr>
                              <td>{{$coupon->coupon_id}}</td>
                              <td>{{$coupon->title}}</td>
                              <td>{{$coupon->coupon_code}}</td>
                              <td>{{$coupon->start_date}}</td>
                              <td>{{$coupon->end_date}}</td>
                              <td>{{$coupon->discount}}</td>
                              <td><button onClick="location.href = '{{Request::root()}}/buyerdashboard/update-coupon/{{$coupon->coupon_id}}';" type="button" class="btn btn-danger">Update</button></td>
                              <td><button onClick="location.href = '{{Request::root()}}/buyerdashboard/manage-rules/{{$coupon->coupon_id}}';" type="button" class="btn btn-danger">Rules</button></td>
                              <td><button onClick="location.href = '{{Request::root()}}/buyerdashboard/delete-coupon/{{$coupon->coupon_id}}';" type="button" class="btn btn-danger">Delete</button></td>
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