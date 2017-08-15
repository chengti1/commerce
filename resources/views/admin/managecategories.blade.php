@extends('admin.layouts.admindashboardlayout')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button onClick = "location.href='{{Request::root()}}/admindashboard/addproductcategory'" type="button" class="btn btn-primary">Add</button>
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
                            <th class="column-title">Category Id </th>
                            <th class="column-title">Category Name </th>
                            <th class="column-title">Category Image </th>
                            <th class="column-title">Edit </th>
                            <th class="column-title">Delete </th>
                            <th class="column-title">Manage Subcategories </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($categories as $category)
                            <tr>
                              <td>{{$category->category_id}}</td>
                              <td>{{$category->category_name}}</td>
                              <td><img width = "100" height = "100" src = "{{Request::root()}}/images/product_category/{{$category->category_image}}" /></td>
                              <td><button onClick="location.href = '{{Request::root()}}/admindashboard/editproductcategory?id={{$category->category_id}}';" type="button" class="btn btn-success">Edit</button></td>
                              <td><button onClick="location.href = '{{Request::root()}}/admindashboard/deleteproductcategory?id={{$category->category_id}}';" type="button" class="btn btn-danger">Delete</button></td>
                              <td><button type="button" onClick="location.href = '{{Request::root()}}/admindashboard/viewsubcategories?id={{$category->category_id}}';" class="btn btn-primary">Subcategories</button></td>
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