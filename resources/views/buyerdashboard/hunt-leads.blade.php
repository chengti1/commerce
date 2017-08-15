@extends('layouts.buyerdashboardlayout')



@section('content')



        <div class = "box">

       <div class="box-heading">Hunt Transactions</div>

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

                    </div>

                  </div>

                </div>

              </div>

              </div>

</div>



@stop
