@extends('layouts.buyerdashboardlayout')



@section('content')



        <div class = "box">

       <div class="box-heading">Swap Transactions</div>

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



                    <div class="table-responsive" style="overflow-x:auto;">

                      <table class="table table-striped jambo_table bulk_action">

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
                          </tr>
                          @endforeach

                        <tbody>



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
