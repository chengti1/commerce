@extends('admin.layouts.admindashboardlayout')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" onClick = "location.href='{{Request::root()}}/admindashboard/addbrand'" class="btn btn-primary">Add</button>
                      </li>
                    </ul>
                    <h2>Manage Categories </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Brand Id </th>
                            <th class="column-title">Brand Name </th>
                            <th class="column-title">Edit </th>
                            <th class="column-title">Delete </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($brands as $brand)
                            <tr>
                              <td>{{$brand->brand_id}}</td>
                              <td>{{$brand->brand_name}}</td>
                              <td><button type="button" onClick = "location.href='{{Request::root()}}/admindashboard/editbrands?id={{$brand->brand_id}}'" class="btn btn-success">Edit</button></td>
                              <td><button type="button" onClick = "location.href='{{Request::root()}}/admindashboard/deletebrand?id={{$brand->brand_id}}'" class="btn btn-danger">Delete</button></td>
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

@stop