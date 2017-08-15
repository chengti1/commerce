@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Tell us the Start and End date for your Listing...</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change Password</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{ Request::root() }}/buyerdashboard/changesellerpassword">
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
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Old Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="password" required="required" class="form-control col-md-7 col-xs-12" name = "password" minlength="8" maxlength="50" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="newpassword" name="newpassword" required="required" class="form-control col-md-7 col-xs-12" minlength="8" maxlength="50" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.confirmpassword.pattern = this.value;
" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="confirmpassword" class="form-control col-md-7 col-xs-12" type="password" name="confirmpassword" minlength="8" maxlength="50" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
" required/>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Change Password</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>

@stop