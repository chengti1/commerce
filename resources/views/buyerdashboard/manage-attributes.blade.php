@extends('layouts.buyerdashboardlayout')



@section('content')



        <div class = "box">

       <div class="box-heading">Manage Product Attributes...</div>

        <div class="right_col" role="main">

        <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <div class="clearfix"></div>

                  </div>

                  <div class="x_content">

                    <br>

                    @if (ISSET($error))

                      <div class="alert alert-danger">

                        {{ $error }}

                      </div>

                    @endif

                    @if (session('success'))

                      <div class="alert alert-success">

                        {{ session('success') }}

                      </div>

                    @endif

                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					  
					  @foreach($attributes as $item)
						<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">{{$item->attribute_name}}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<?php $attribute_value = \DB::table('product_attributes')->where('product_id',$product_id)->where('attribute_id',$item->id)->first(['value']);
						?>
						
                          <select name="{{$item->id}}" style="width:100%;" class="attribute">
								<option value="">Select {{$item->attribute_name}}</option>
							@foreach(explode(',',$item->options) as $item1)
								@if(count($attribute_value) == 1)
									@if($item1 == $attribute_value->value)
										<option value="{{$item1}}" selected >{{$item1}}</option>
									@else
										<option value="{{$attribute_value->value}}" selected>{{$attribute_value->value}}</option>
										<option value="{{$item1}}">{{$item1}}</option>
									@endif
								@else
									<option value="{{$item1}}">{{$item1}}</option>
								@endif
							@endforeach
						  </select>
							<input type="text" id = "{{$item->id}}_text" name = "{{$item->id}}_text" style="display:none;width:100%;" />
                          @if($errors->has($item->id))

                            <div class="alert alert-danger">

                              {{$errors->first($item->id)}}

                            </div>

                          @endif

                        </div>

                      </div>
					  @endforeach

                      <div class="ln_solid"></div>
						@if(count($attributes) != 0)
                      <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                          <button type="submit" name = "submit" class="btn btn-success">Save</button>

                        </div>

                      </div>
					@endif


                    </form>

                  </div>

                </div>

              </div>

</div>



@stop