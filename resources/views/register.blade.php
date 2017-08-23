@extends('layouts.layout')
@section('content')
{{Html::script('js/countries.js')}}
<div class="breadcrumb full-width">
	<div class="background-breadcrumb"></div>
	<div class="background">
		<div class="shadow"></div>
		<div class="pattern">
			<div class="container">
				<div class="clearfix">
					<h1 id="title-page">Register Account</h1>
					<ul>
						<li><a href="{{Request::root()}}">Home</a></li>
						<li><a href="{{Request::root()}}/register">Register</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="main-content full-width inner-page">
	<div class="background-content"></div>
	<div class="background">
		<div class="shadow"></div>
		<div class="pattern">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-9 center-column">
								<p>If you already have an account with us, please login at the <a href="login">login page</a>.</p>
								<form action="register" method="post" enctype="multipart/form-data" class="form-horizontal">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<fieldset>
										@if(ISSET($error) && $error !== '')
										<div class="alert alert-danger">
											{{$error}}
										</div>
										@endif
										<div class="form-group required" style="display: none;">
											<label class="col-sm-2 control-label">Customer Group</label>
											<div class="col-sm-10">
												<div class="radio">
													<label>Default</label>
												</div>
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-firstname">First Name</label>
											<div class="col-sm-10">
												<input type="text" name="FirstName" value="{{ old('FirstName') }}" placeholder="First Name" id="input-firstname" class="form-control" minlength="3" maxlength="50" " pattern="[a-zA-Z]+" required />
												@if($errors->has('FirstName'))
												<div class="alert alert-danger">
													{{$errors->first('FirstName')}}
												</div>
												@endif
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-LastName">Last Name</label>
											<div class="col-sm-10">
												<input type="text" name="LastName" value="{{ old('LastName') }}" placeholder="Last Name" id="input-lastname" class="form-control" minlength="3" maxlength="50" pattern="[a-zA-Z]+" required />
												@if($errors->has('LastName'))
												<div class="alert alert-danger">
													{{$errors->first('LastName')}}
												</div>
												@endif
											</div>
										</div>
										<input type="hidden" value="1" name="usertype" />
										<!--<div class="form-group required">
											<label class="col-sm-2 control-label" for="usertype">User Type</label>
											<div class="col-sm-10">
												<select id="usertype" class="form-control" name = "usertype" value = "{{ old('usertype') }}" required>
													<option value = "1">Buyer</option>
													<option value = "0">Seller</option>
												</select>
												@if($errors->has('usertype'))
												 <div class="alert alert-danger">
														{{$errors->first('usertype')}}
												 </div>
												@endif
											</div>
										</div>-->
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-email">E-Mail</label>
											<div class="col-sm-10">
												<input type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail" id="input-email" class="form-control" required/>
												@if($errors->has('email'))
												<div class="alert alert-danger">
													{{$errors->first('email')}}
												</div>
												@endif
											</div>
										</div>
										<div class="form-group required">
											<label class="col-sm-2 control-label" for="input-telephone">Mobile Number</label>
											<div class="col-sm-10">
												<input type="text" name="mobilenumber" value="{{old('mobilenumber')}}" placeholder="Mobile Number starting with +CountryCode" id="input-telephone" class="form-control" required pattern = "[\+]\d{8,20}" required/>
												@if($errors->has('mobilenumber'))
												<div class="alert alert-danger">
													{{$errors->first('mobilenumber')}}
												</div>
												@endif
											</div>
										</div>
										<fieldset>
											<legend>Your Address</legend>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="input-company">Company</label>
												<div class="col-sm-10">
													<input type="text" name="company" value="{{old('company')}}" placeholder="Company" id="input-company" class="form-control" minlength="3" maxlength="50" >
													@if($errors->has('company'))
													<div class="alert alert-danger">
														{{$errors->first('company')}}
													</div>
													@endif
												</div>
											</div>
											<div class="form-group required">
												<label class="col-sm-2 control-label" for="input-address-1">Address 1</label>
												<div class="col-sm-10">
													<input type="text" name="address1" value="{{old('address1')}}" placeholder="Address 1" id="input-address-1" class="form-control" minlength="3" maxlength="50" required/>
													@if($errors->has('address1'))
													<div class="alert alert-danger">
														{{$errors->first('address1')}}
													</div>
													@endif
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="input-address-2" for="input-address-2">Address 2</label>
												<div class="col-sm-10">
													<input type="text" name="address2" value="{{old('address2')}}" placeholder="Address 2" id="input-address-2" class="form-control" minlength="3" maxlength="50">
													@if($errors->has('address2'))
													<div class="alert alert-danger">
														{{$errors->first('address2')}}
													</div>
													@endif
												</div>
											</div>
											<div class="form-group required">
												<label class="col-sm-2 control-label" for="country">Country</label>
												<div class="col-sm-10">
													<select name="country" value = "{{old('country')}}" placeholder="country" id="country" class="form-control" required></select>
													@if($errors->has('country'))
													<div class="alert alert-danger">
														{{$errors->first('country')}}
													</div>
													@endif
												</div>
											</div>
											<div class="form-group required">
												<label class="col-sm-2 control-label" for="region">Region</label>
												<div class="col-sm-10">
													<select name="region" value = "{{old('region')}}" placeholder="Region" id="state" class="form-control" required></select>
													@if($errors->has('region'))
													<div class="alert alert-danger">
														{{$errors->first('region')}}
													</div>
													@endif
												</div>
											</div>
											<div class="form-group required">
												<label class="col-sm-2 control-label" for="input-postcode">Post Code</label>
												<div class="col-sm-10">
													<input type="number" name="postalcode" value="{{old('postalcode')}}" placeholder="Post Code" id="input-postcode" class="form-control" min="0" required/>
													@if($errors->has('postalcode'))
													<div class="alert alert-danger">
														{{$errors->first('postalcode')}}
													</div>
													@endif
												</div>
											</div>
										</fieldset>
										<fieldset>
											<legend>Your Password</legend>
											<div class="form-group required">
												<label class="col-sm-2 control-label" for="input-password">Password</label>
												<div class="col-sm-10">
													<input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" minlength="8" maxlength="50" required/>
													@if($errors->has('password'))
													<div class="alert alert-danger">
														{{$errors->first('password')}}
													</div>
													@endif
												</div>
											</div>
											<div class="form-group required">
												<label class="col-sm-2 control-label" for="input-password">Paypal Email</label>
												<div class="col-sm-10">
													<input type="email" name="paypalemail" value="{{old('paypalemail')}}" placeholder="Paypal Email" id="paypalemail" class="form-control" required/>
													@if($errors->has('paypalemail'))
													<div class="alert alert-danger">
														{{$errors->first('paypalemail')}}
													</div>
													@endif
												</div>
											</div>
										</fieldset>
										<fieldset>
											<legend>Newsletter</legend>
											<div class="form-group">
												<label class="col-sm-2 control-label">Subscribe</label>
												<div class="col-sm-10">
													<label class="radio-inline"><input type="radio" name="newsletter" value="1" />Yes</label>
													<label class="radio-inline"><input type="radio" name="newsletter" value="0" checked="checked" />No</label>
													@if($errors->has('newsletter'))
													<div class="alert alert-danger">
														{{$errors->first('newsletter')}}
													</div>
													@endif
												</div>
											</div>
										</fieldset>
										<div class="buttons">
											<!-- div for captcha edited by kartik. -->
											<div class="refereshrecapcha">
												{!! Captcha::img('flat'); !!} <br>
											</div>
											<input type="text" name="captcha" id="captcha" placeholder="Please input Captcha" required >
											<a href="javascript:void(0)" onclick="refreshCaptcha()">Refresh</a>
											<!-- end div captcha -->
											<!-- <input type="text" name="captcha" placeholder="Please input Captcha" required > -->
											@if($errors->has('captcha'))
											<div class="alert alert-danger">
												{{$errors->first('captcha')}}
											</div>
											@endif
											<div class="pull-right">
												I have read and agree to the <a href="index11ee.html?route=information/information/agree&amp;information_id=3" class="agree"><b>Privacy Policy</b></a>
												<input type="checkbox" name="agree" value="1" required/>&nbsp;<input type="submit" value="Continue" class="btn btn-primary"/>
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-3">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- prashant Kumar -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.11.1/validate.min.js"></script> -->
<script type="text/javascript" src="  http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.js"></script>
<script language="javascript">
	populateCountries("country", "state"); // first parameter is id of country drop-down and second parameter is id of state
	$(document).ready(function(){
		$('#country option[value="{{old("country")}}"]').attr('selected', 'selected');
		$('#usertype option[value="{{old("usertype")}}"]').attr('selected', 'selected');
		if($("#country").val()!='-1')
		{
			populateStates( 'country', 'state' );
		}
		$('#state option[value="{{old("region")}}"]').attr('selected', 'selected');
	});
</script>
<!-- script for captcha -->
<script>
	function refreshCaptcha(){
		$.ajax({
			url: "refereshcapcha",
			type: 'get',
			dataType: 'html',
			success: function(json) {
				$('.refereshrecapcha').html(json);
			},
			error: function(data) {
				alert('Try Again.');
			}
		});
	}
</script>
<!-- end script captcha -->
<!-- Prashant Kumar -->
<script type="text/javascript">
	$(document).ready(function () {
		$('#signupForm').validate({
			rules : {
				FirstName    : "required",
				LastName     : "required",
				usertype     : "required",
				email        : {
					required: true,
					email: true
				},
				mobilenumber : {
					required : true,
				},
				company      : {
					required: true,
					minlength : 3,
				},
				address1     : {
					required: true,
					minlength : 3,
				},
				address2     : {
					required: true,
					minlength : 3,
				},

				country      : "required",
				region       : "required",
				postalcode   : "required",
				password     : {
					required: true,
					minlength: 8
				},
				paypalemail  : {
					required: true,
					email: true
				},
				agree        : {
					required: $('#hasCRB').is(':checked')
				},
			},
			messages : {
				FirstName    : "firstname should must filled",
				LastName     : "lastname should must filled",
				usertype     : "usertype should must filled",
				email        :{
					required : "email should must filled",
					true : "Please enter a valid email address.",
				},
				mobilenumber : {
					required : "mobilenumber should must filled and followed by country code",
				},
				company      : {
					required : "company should must filled",
					minlength : "Your company name must be at least 3 characters long",
				},
				address1     : {
					required : "address1 should must filled",
					minlength : "address1 must be at least 3 characters long",
				},
				address2     : {
					required : "address2 should must filled",
					minlength : "address1 must be at least 3 characters long",
				},
				country      : "country should must filled",
				region       : "Please select country first Or select or state.",
				postalcode   : "postalcode should must filled",
				password     : {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long",
				},
				paypalemail  : {
					required : "email should must filled",
					true : "Please enter a valid paypal email address.",
				},
				agree        : {
					required : "privacy and policy should must be checked",
				},


			},
			submitHandler: function (form) { // for demo
					return false; // for demo
				}
			});
	});
</script>
<style type="text/css">
	form .error {
		color: #ff0000;
	}
</style>
<!-- Prashant Kumar -->
@stop
