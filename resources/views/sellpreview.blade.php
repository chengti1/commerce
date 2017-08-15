@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Preview</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/buyerdashboard/sellpreview" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Title
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="ptitle" class="form-control col-md-7 col-xs-12" name = "ptitle" value = "{{session('product_name')}}" required readonly />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Category
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="ptitle" class="form-control col-md-7 col-xs-12" name = "ptitle" value = "{{$category->category_name}}" readonly required />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Selling Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="ptitle" class="form-control col-md-7 col-xs-12" name = "ptitle" value = "{{$selltype->sell_type}}" readonly required />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="ptitle" class="form-control col-md-7 col-xs-12" name = "ptitle" value = "{{$subcategory->category_name}}" readonly required />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label required readonly>{!!session('product_description')!!}</textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Keywords</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class = "form-control col-md-7 col-xs-12" required readonly>{{session('keywords')}}</textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img width = "100px" height = "100px" src="{{asset('images/product_master').'/'.session('product_images')}}">
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Actual Price</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sellprice" class="form-control col-md-7 col-xs-12" name = "sellprice" value = "{{session('actual_price')}}" readonly required />
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Selling Price
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sellprice" class="form-control col-md-7 col-xs-12" name = "sellprice" value = "{{session('selling_price')}}" readonly required />
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Discount (If any)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sellprice" class="form-control col-md-7 col-xs-12" name = "sellprice" value = "{{session('discount')}}" readonly required />
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Price after discount
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="sellprice" class="form-control col-md-7 col-xs-12" name = "sellprice" value = "{{session('discount_price')}}" readonly required />
                        </div>
                        </div>
                      </div> -->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button name = "back" class="btn btn-cancel" onClick="history.go(-1);return true;">Back</button>
                          <button type="submit" name = "submit" class="btn btn-success">Save</button>

                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>

@stop
