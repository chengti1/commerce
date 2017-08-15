@extends('layouts.buyerdashboardlayout')

@section('content')
       <div class = "box">
       <div class="box-heading">Hunt an Item</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/buyerdashboard/hunt-an-item" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Image</label> <a id = "show_optional">Add more images</a>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::file('image') !!}
                          @if($errors->has('image'))
                            <div class="alert alert-danger">
                              {{$errors->first('image')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div id = "optional_images">
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Image 1</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::file('image1') !!}
                            @if($errors->has('image1'))
                              <div class="alert alert-danger">
                                {{$errors->first('image1')}}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Image 2</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::file('image2') !!}
                            @if($errors->has('image2'))
                              <div class="alert alert-danger">
                                {{$errors->first('image2')}}
                              </div>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Image 3</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::file('image3') !!}
                            @if($errors->has('image3'))
                              <div class="alert alert-danger">
                                {{$errors->first('image3')}}
                              </div>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type = "text" name = "productname" id = "productname" class = "form-control col-md-7 col-xs-12" required>
                          @if($errors->has('productname'))
                            <div class="alert alert-danger">
                              {{$errors->first('productname')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Category 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="categories" class="form-control col-md-7 col-xs-12" name="category">
                          <option>Select a Category</option>
                          @foreach($categories as $category)
                            <option value = "{{$category->category_id}}">{{$category->category_name}}</option>
                          @endforeach
                          </select>
                          @if($errors->has('category'))
                            <div class="alert alert-danger">
                              {{$errors->first('category')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="scategory" class="form-control col-md-7 col-xs-12" name="scategory">
                          </select>
                          @if($errors->has('scategory'))
                            <div class="alert alert-danger">
                              {{$errors->first('scategory')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Price
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type = "text" name = "price" id = "price" class = "form-control col-md-7 col-xs-12" required>
                          @if($errors->has('price'))
                            <div class="alert alert-danger">
                              {{$errors->first('price')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Swap Item
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type = "radio" name = "swap" id = "swapyes" value = "1">Yes &nbsp
                          <input type = "radio" name = "swap" id = "swapno" value = "0" checked>No
                          @if($errors->has('swap'))
                            <div class="alert alert-danger">
                              {{$errors->first('swap')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" name = "description" class="form-control col-md-7 col-xs-12 ckeditor"  required>{{session('product_description')}}</textarea>
                          @if($errors->has('description'))
                            <div class="alert alert-danger">
                              {{$errors->first('description')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Keywords</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="keywords" name = "keywords" class="form-control col-md-7 col-xs-12"  required>{{session('keywords')}}</textarea>
                          @if($errors->has('keywords'))
                            <div class="alert alert-danger">
                              {{$errors->first('keywords')}}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name = "submit" class="btn btn-success">Continue</button>
                        </div>
                      </div>

                    </form>
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>

       <script>
         $(document).ready(function(){
           $('#optional_images').hide();
           $('#show_optional').click(function(){
             $('#optional_images').show();
             $('#show_optional').attr('id', 'hide_optional');
           });
         });
       </script>

@stop