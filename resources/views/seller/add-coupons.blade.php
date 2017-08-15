@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Add Coupons</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{ Request::root() }}/buyerdashboard/add-coupon">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Title
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" class="form-control col-md-7 col-xs-12" name = "title" value = "{{ old('title') }}" minlength="3" maxlength="500" required />
                        </div>
                      </div>
                          @if($errors->has('title'))
                            <div class="alert alert-danger">
                              {{$errors->first('title')}}
                            </div>
                          @endif
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Coupon Code 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="code" name="code" required="required" class="form-control col-md-7 col-xs-12" value = "{{ old('code') }}" minlength="3" maxlength="50" pattern="[a-zA-Z0-9]+" required />
                        </div>
                      </div>
                          @if($errors->has('code'))
                            <div class="alert alert-danger">
                              {{$errors->first('code')}}
                            </div>
                          @endif
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="start" class="form-control col-md-7 col-xs-12" type="date" name="start" value = "{{ old('start') }}" required />
                        </div>
                      </div>
                          @if($errors->has('start'))
                            <div class="alert alert-danger">
                              {{$errors->first('start')}}
                            </div>
                          @endif
                        <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">End Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="end" class="form-control col-md-7 col-xs-12" type="date" name="end" value = "{{ old('end') }}" required />
                        </div>
                      </div>
                          @if($errors->has('end'))
                            <div class="alert alert-danger">
                              {{$errors->first('end')}}
                            </div>
                          @endif
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Discount Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type = "radio" name = "discount_option" id = "percent" value = "1">Percentage &nbsp
                          <input type = "radio" name = "discount_option" id = "fixed" value = "0" checked>Fixed
                          @if($errors->has('discount_option'))
                            <div class="alert alert-danger">
                              {{$errors->first('discount_option')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Discount</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="discount" class="form-control col-md-7 col-xs-12" type="number" name="discount" value = "{{ old('discount') }}" required>
                        </div>
                      </div>
                          @if($errors->has('discount'))
                            <div class="alert alert-danger">
                              {{$errors->first('discount')}}
                            </div>
                          @endif
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

@stop