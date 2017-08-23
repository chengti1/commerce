@extends('layouts.buyerdashboardlayout')
@section('content')
{{Html::script('js/countries.js')}}
<div class = "box">
    <div class="box-heading">Profile Details</div>
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method="post" action="{{ url('update-profile') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">First Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="fname" class="form-control col-md-7 col-xs-12" name="fname" minlength="3" maxlength="50" value="{{ old('fname') ? old('fname') : $userData->first_name }}" required />
                                @if ($errors->has('fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lname">Last Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="lname" name="lname" required="required" class="form-control col-md-7 col-xs-12" value="{{ old('fname') ? old('fname') : $userData->last_name }}" minlength="3" maxlength="50" required />
                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" required />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Company</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="company" class="form-control col-md-7 col-xs-12" type="text" name="company" value="{{ old('company') ? old('company') : $userData->company }}" minlength="3" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('add1') ? ' has-error' : '' }}">
                            <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Address 1</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="add1" class="form-control col-md-7 col-xs-12" type="text" name="add1" value="{{ old('add1') ? old('add1') : $userData->address1 }}" minlength="3" maxlength="50" required>
                                @if ($errors->has('add1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Address 2</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="add2" class="form-control col-md-7 col-xs-12" type="text" name="add2" value="{{ old('add1') ? old('add1') : $userData->address2 }}" minlength="3" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="country" placeholder="country" id="country" class="form-control col-md-7 col-xs-12" required></select>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="region">Region</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="region" placeholder="Region" id="state" class="form-control col-md-7 col-xs-12" required></select>
                                @if ($errors->has('region'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Postal Code</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="pcode" class="form-control col-md-7 col-xs-12" type="number" name="pcode" value="{{ old('pcode') ? old('pcode') : $userData->postal_code }}" min="0" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Paypal Email</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="paypalemail" class="form-control col-md-7 col-xs-12" type="email" name="paypalemail" value = "{{ $userData->paypal_email }}">
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

        <script language="javascript">
            populateCountries("country", "state"); // first parameter is id of country drop-down and second parameter is id of state


                $(document).ready(function(){
                $('#country option[value="{{ $userData->country }}"]').attr('selected', 'selected');
                if($("#country").val()!='-1')
                {
                   populateStates( 'country', 'state' );
                }
                $('#state option[value="{{ $userData->region }}"]').attr('selected', 'selected');
            });
        </script>
    </div>
</div>
@stop
