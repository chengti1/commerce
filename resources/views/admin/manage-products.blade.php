@extends('admin.layouts.admindashboardlayout')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Manage Products</a>
                        </li>
                        <!--<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Swapping Products</a>
                        </li>												<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Hunting Products</a>                        </li>-->
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <ul class="nav navbar-right panel_toolbox">
                      <li><button onClick = "location.href='{{Request::root()}}/admindashboard/addproduct'" type="button" class="btn btn-primary">Add</button>
                      </li>
                    </ul>
                    <h2>Manage Selling Products</h2>
                    <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action myTable">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">S. No.</th>
                            <th class="column-title">Product ID</th>							<th class="column-title">Name</th>
                            <th class="column-title">Seller Name</th>
                            <th class="column-title">Image</th>
                            <th class="column-title">Seller Price</th>
                            <th class="column-title">Display Price</th>
                            <th class="column-title">Discount</th>							<th class="column-title">Discounted Price</th>
                            <th class="column-title">Category</th>							<th class="column-title">Sub Category</th>							<th class="column-title">Status</th>							<th class="column-title">Update</th>
                          </tr>
                        </thead>
                        <tbody>						<?php $i = 1; ?>
                          @foreach($selling_products as $item)
                            <tr>							  <td>{{$i}}</td>
                              <td>{{$item->product_id}}</td>
                              <td><u><a href = '{{Request::root()}}/product-detail/{{$item->product_id}}'>{{$item->product_name}}</a></u></td>
                              <td>{{$item->seller_name}}</td>
                              <td><img height="100px" width="100px" src="{{Request::root()}}/images/product_master/{{$item->product_images}}"></td>
                              <td>${{$item->product_price}}</td>
                              <td>${{$item->display_price}}</td>							  <td>{{$item->seller_discount}}%</td>							  <td>${{$item->price_after_discount}}</td>                              <td>{{$item->category_name}}</td>                              <td>{{$item->subcategory_name}}</td>                              <td><?= ($item->status_value == 0)?'Inactive':'Active' ?></td>							  <td><button onClick="location.href = '{{Request::root()}}/admindashboard/update-product/{{$item->product_id}}';" type="button" class="btn btn-success">Update</button></td>
                            </tr>							<?php $i++; ?>
                          @endforeach
                        </tbody>
                      </table>					  
                    </div>
                  </div>
                    <div class="clearfix"></div>

                        </div>
                      </div>
                    </div>
                    
                  </div>

                  
                </div>
              </div>
              </div>
</div>

@stop