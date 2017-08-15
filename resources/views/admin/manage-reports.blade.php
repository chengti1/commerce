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
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Selling Reports</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Swapping Reports</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Hunting Reports</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          
                    <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action myTable" id = "myTable">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">S.No.</th>
                            <th class="column-title">Transaction Id</th>
                            <th class="column-title">Amount Paid</th>
                            <th class="column-title">Buyer Name</th>
                            <th class="column-title">Seller Name</th>
                            <th class="column-title">Product Name</th>
                            <th class="column-title">Quantity</th>
                            <th class="column-title">Transaction Date and Time</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php $sno = 0; ?>
                          @foreach($transactions as $transaction)
                            <?php $sno++; ?>
                            <tr>
                              <td>{{$sno}}</td>
                              <td>{{$transaction->transaction_id}}</td>
                              <td>{{$transaction->amount_paid}}</td>
                              <td>{{$transaction->buyer_name}}</td>
                              <td>{{$transaction->seller_name}}</td>
                              <td>{{$transaction->product_name}}</td>
                              <td>{{$transaction->quantity}}</td>
                              <td>{{$transaction->created_at}}</td>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                    <div class="clearfix"></div>

                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          
                    <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action myTable" id = "myTable">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">S.No.</th>
                            <th class="column-title">Buyer Transaction Id</th>
                            <th class="column-title">Buyer Amount Paid</th>
                            <th class="column-title">Buyer Name</th>
                            <th class="column-title">Buyer Product Name</th>
                            <th class="column-title">Buyer Transaction Date and Time</th>
                            <th class="column-title">Seller Transaction Id</th>
                            <th class="column-title">Seller Amount Paid</th>
                            <th class="column-title">Seller Name</th>
                            <th class="column-title">Seller Product Name</th>
                            <th class="column-title">Seller Transaction Date and Time</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php $sno = 0; ?>
                          @foreach($swap_transactions as $swap_transaction)
                            <?php $sno++; ?>
                            <tr>
                              <td>{{$sno}}</td>
                              <td>{{$swap_transaction->buyer_transaction_id}}</td>
                              <td>{{$swap_transaction->buyer_amount_paid}}</td>
                              <td>{{$swap_transaction->buyer_name}}</td>
                              <td>{{$swap_transaction->buyer_product}}</td>
                              <td>{{$swap_transaction->updated_at}}</td>
                              <td>{{$swap_transaction->seller_transaction_id}}</td>
                              <td>{{$swap_transaction->seller_amount_paid}}</td>
                              <td>{{$swap_transaction->seller_name}}</td>
                              <td>{{$swap_transaction->seller_product}}</td>
                              <td>{{$swap_transaction->created_at}}</td>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                    <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          
                    <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action myTable" id = "myTable">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">S.No.</th>
                            <th class="column-title">For Product</th>
                            <th class="column-title">Buyer Transaction Id</th>
                            <th class="column-title">Buyer Amount Paid</th>
                            <th class="column-title">Buyer Name</th>
                            <th class="column-title">Buyer Product Name</th>
                            <th class="column-title">Buyer Transaction Date and Time</th>
                            <th class="column-title">Seller Name</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php $sno = 0; ?>
                          @foreach($hunt_transactions as $hunt_transaction)
                            <?php $sno++; ?>
                            <tr>
                              <td>{{$sno}}</td>
                              <td>{{$hunt_transaction->for_product}}</td>
                              <td>{{$hunt_transaction->buyer_transaction_id}}</td>
                              <td>{{$hunt_transaction->buyer_amount_paid}}</td>
                              <td>{{$hunt_transaction->buyer_name}}</td>
                              <td>{{$hunt_transaction->product_name}}</td>
                              <td>{{$hunt_transaction->created_at}}</td>
                              <td>{{$hunt_transaction->seller_name}}</td>
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