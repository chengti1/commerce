@extends('admin.layouts.admindashboardlayout')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" onClick="location.href = '{{Request::root()}}/admindashboard/addsubcategory?parent_id={{$category_id}}';" class="btn btn-primary">Add</button>
                      </li>
                    </ul>
                    <h2>Manage Subcategories </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Subcategory Id </th>
                            <th class="column-title">Parent Id </th>
                            <th class="column-title">Subcategory Name </th>
                            <th class="column-title">Edit </th>
                            <th class="column-title">Delete </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach($subcategories as $subcategory)
                            <tr>
                              <td>{{$subcategory->category_id}}</td>
                              <td>{{$subcategory->parent_id}}</td>
                              <td>{{$subcategory->category_name}}</td>
                              <td><button type="button" onClick="location.href = '{{Request::root()}}/admindashboard/editsubcategory?parent_id={{$subcategory->parent_id}}&id={{$subcategory->category_id}}';" class="btn btn-success">Edit</button></td>
                              <td><button type="button" onClick="location.href = '{{Request::root()}}/admindashboard/deletesubcategory?parent_id={{$subcategory->parent_id}}&id={{$subcategory->category_id}}';" class="btn btn-danger">Delete</button></td>
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