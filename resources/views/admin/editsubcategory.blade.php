@extends('admin.layouts.admindashboardlayout')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Product Subcategory</h2>
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/admindashboard/editsubcategory" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name = "category_id" value = "{{$subcategories->category_id}}">
                    <input type="hidden" name = "parent_id" value = "{{$subcategories->parent_id}}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Subcategory Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" class="form-control col-md-7 col-xs-12" name = "name" value = "{{$subcategories->category_name}}" minlength="3" maxlength="50"  required />
                          @if($errors->has('name'))
                            <div class="alert alert-danger">
                              {{$errors->first('name')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Select Attributes</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name = "attributes[]" id="attributes" class="form-control col-md-7 col-xs-12" multiple>
                            @foreach($attributes as $attribute)								@foreach($selected_attributes as $selected)									@if($attribute->id == $selected)										<option value = "{{$attribute->id}}" selected>{{$attribute->attribute_name}}</option>										@else										<option value = "{{$attribute->id}}">{{$attribute->attribute_name}}</option>									@endif								@endforeach							@endforeach
                          </select>
                          @if($errors->has('attributes'))
                            <div class="alert alert-danger">
                              {{$errors->first('attributes')}}
                            </div>
                          @endif
                        </div>
                      </div>					  					  <div class="form-group">                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>                        <div class="col-md-6 col-sm-6 col-xs-12">                          <select name = "status" class="form-control col-md-7 col-xs-12" selected = "{{$subcategories->status_value}}">                            <option value = "0" <?= ($subcategories->status_value == 0)?'selected':'' ?> >Not Visible</option>                            <option value = "1" <?= ($subcategories->status_value == 1)?'selected':'' ?> >Visible</option>                          </select>                          @if($errors->has('status'))                            <div class="alert alert-danger">                              {{$errors->first('status')}}                            </div>                          @endif                        </div>                      </div>
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