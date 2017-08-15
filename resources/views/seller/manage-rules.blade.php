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
       <div class="box-heading">Manage Rules</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    @if(count($rules) == 0)
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button onClick = "location.href='{{Request::root()}}/buyerdashboard/add-rule/{{$id}}'" type="button" class="btn btn-primary">Add</button>
                      </li>
                    </ul>
                    @endif
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
                            <th class="column-title">Maximum Amount</th>
                            <th class="column-title">Minimum Amount</th>
                            <th class="column-title">Update</th>
                            <th class="column-title">Delete</th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($rules as $rule)
                            <tr>
                              <td>{{$rule->coupon_id}}</td>
                              <td>{{$rule->title}}</td>
                              <td>{{$rule->coupon_code}}</td>
                              <td>{{$rule->maximum_amount}}</td>
                              <td>{{$rule->minimum_amount}}</td>
                              <td><button onClick="location.href = '{{Request::root()}}/buyerdashboard/update-rule/{{$rule->coupon_id}}';" type="button" class="btn btn-danger">Update</button></td>
                              <td><button onClick="location.href = '{{Request::root()}}/buyerdashboard/delete-rule/{{$rule->coupon_id}}';" type="button" class="btn btn-danger">Delete</button></td>
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