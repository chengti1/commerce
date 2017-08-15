@extends('layouts.buyerdashboardlayout')



@section('content')

    <div class="box">

        <div class="box-heading">What are you selling?</div>

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

                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method="post"

                      action="{{Request::root()}}/buyerdashboard/sellstepone" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">



                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Title

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <input type="text" id="ptitle" class="form-control col-md-7 col-xs-12" name="ptitle"

                                   value="{{session('product_name')}}" minlength="3" maxlength="100" required/>

                            @if($errors->has('ptitle'))

                                <div class="alert alert-danger">

                                    {{$errors->first('ptitle')}}

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

                                    <option value="{{$category->category_id}} ">{{$category->category_name}}</option>

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

                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Sub

                            Category</label>

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

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Selling Type

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <select id="stype" class="form-control col-md-7 col-xs-12" name="stype">

                                <option>Select a Type</option>

                                @foreach($selltype as $selltypes)

                                    <option value="{{$selltypes->sell_type_id}}">{{$selltypes->sell_type}}</option>

                                @endforeach

                            </select>

                            @if($errors->has('stype'))

                                <div class="alert alert-danger">

                                    {{$errors->first('stype')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Status</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <select id="stype" class="form-control col-md-7 col-xs-12" name="status">
                                <option>Select a Status</option>
                                <option value="New">New</option>
                                <option value="Pre-owned">Pre-owned</option>
                                <option value="Refurbished">Refurbished</option>
                            </select>

                            @if($errors->has('status'))

                                <div class="alert alert-danger">

                                    {{$errors->first('status')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Item Location</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <input type="text" class="form-control col-md-7 col-xs-12" name="location" value="{{$userData->region}}, {{$userData->country}}" required >

                            @if($errors->has('location'))

                                <div class="alert alert-danger">

                                    {{$errors->first('location')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    <!--<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Quantity</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <input type="number" class="form-control col-md-7 col-xs-12" name="quantity" value="" required>

                            @if($errors->has('quantity'))

                                <div class="alert alert-danger">

                                    {{$errors->first('quantity')}}

                                </div>

                            @endif

                        </div>

                    </div>-->

                    <div class="form-group">

                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product

                            Description</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <textarea id="description" name="description"

                                      class="form-control col-md-7 col-xs-12 ckeditor"

                                      required>{{session('product_description')}}</textarea>

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

                            <textarea id="keywords" name="keywords" class="form-control col-md-7 col-xs-12"

                                      required>{{session('keywords')}}</textarea>

                            @if($errors->has('keywords'))

                                <div class="alert alert-danger">

                                    {{$errors->first('keywords')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product

                            Image</label> <a id = "show_optional">Add more images</a>

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

                    <div class="ln_solid"></div>

                    <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                            <button type="submit" name="submit" class="btn btn-success">Continue</button>

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
