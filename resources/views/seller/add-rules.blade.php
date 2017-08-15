@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Add Rules</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{ Request::root() }}/buyerdashboard/add-rule/{{$id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{$id}}">
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Minimum Amount
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="minamount" name="minamount" required="required" class="form-control col-md-7 col-xs-12" value = "{{ old('minamount') }} " min="0" step=".01"  required />
                        </div>
                      </div>
                          @if($errors->has('minamount'))
                            <div class="alert alert-danger">
                              {{$errors->first('minamount')}}
                            </div>
                          @endif

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Maximum Amount
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="maxamount" class="form-control col-md-7 col-xs-12" name = "maxamount" value = "{{ old('maxamount') }}" min="0" step=".01" required />
                        </div>
                      </div>
                          @if($errors->has('maxamount'))
                            <div class="alert alert-danger">
                              {{$errors->first('maxamount')}}
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