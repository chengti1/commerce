@extends('admin.layouts.admindashboardlayout')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Product Category</h2>
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/admindashboard/editproductcategory" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name = "category_id" value = "{{$categories->category_id}}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Category Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" class="form-control col-md-7 col-xs-12" name = "name" value = "{{$categories->category_name}}" minlength="3" maxlength="50"  required />
                          @if($errors->has('name'))
                            <div class="alert alert-danger">
                              {{$errors->first('name')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name = "status" class="form-control col-md-7 col-xs-12" selected = "{{$categories->status_value}}">
                            <option value = "0">Not Visible</option>
                            <option value = "1">Visible</option>
                          </select>
                          @if($errors->has('status'))
                            <div class="alert alert-danger">
                              {{$errors->first('status')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <img width = "100" height = "100" src = "{{Request::root()}}/images/product_category/{{$categories->category_image}}" /><br>
                          {!! Form::file('image') !!}
                          @if($errors->has('image'))
                            <div class="alert alert-danger">
                              {{$errors->first('image')}}
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