@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">What are you selling?</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add a new Payment Method</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/buyerdashboard/addpmethod" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Payment Method
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class = "form-control col-md-7 col-xs-12" name = "method">
                            @foreach($paymentmethods as $paymentmethod)
                              <option value = "{{$paymentmethod->payment_method_id}}">{{$paymentmethod->payment_method}}</option>
                            @endforeach
                          </select>
                          @if($errors->has('method'))
                            <div class="alert alert-danger">
                              {{$errors->first('method')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name = "submit" class="btn btn-success">Add</button>
                        </div>
                      </div>

                    </form>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
</div>

@stop