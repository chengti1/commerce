@extends('admin.layouts.admindashboardlayout')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Brand</h2>
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/admindashboard/update-hunt-commission/{{$commission->commission_id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Commission Percentage</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="percentage" class="form-control col-md-7 col-xs-12" name = "percentage" value = "{{$commission->percentage}}" min="0" max="100"  required />
                          @if($errors->has('percentage'))
                            <div class="alert alert-danger">
                              {{$errors->first('percentage')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Fixed Commission</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="fixed" class="form-control col-md-7 col-xs-12" name = "fixed" value = "{{$commission->fixed}}" min="0"  required />
                          @if($errors->has('fixed'))
                            <div class="alert alert-danger">
                              {{$errors->first('fixed')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Maximum Commission</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="maximum" class="form-control col-md-7 col-xs-12" name = "maximum" value = "{{$commission->maximum}}" min="0"  required />
                          @if($errors->has('maximum'))
                            <div class="alert alert-danger">
                              {{$errors->first('maximum')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name = "submit" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>

@stop