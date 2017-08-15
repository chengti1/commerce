@extends('admin.layouts.admindashboardlayout')



@section('content')



        <!-- page content -->

        <div class="right_col" role="main">

        <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                  <div class="x_title">

                    <h2>Update Product</h2>

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

                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">



                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Product Title

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <input type="text" id="ptitle" class="form-control col-md-7 col-xs-12" name="ptitle"

                                   value="{{$product->product_name}}" minlength="3" maxlength="100" required/>

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
									@if($category->category_id == $product->product_category)
										<option value="{{$category->category_id}} " selected >{{$category->category_name}}</option>
									@else
										<option value="{{$category->category_id}} ">{{$category->category_name}}</option>
									@endif
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
								<option value="{{$product->product_subcategory}}" selected >{{$subcategory->category_name}}</option>
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
									@if($selltypes->sell_type_id == $product->sell_type_id)
										<option value="{{$selltypes->sell_type_id}}" selected >{{$selltypes->sell_type}}</option>
									@else
										<option value="{{$selltypes->sell_type_id}}">{{$selltypes->sell_type}}</option>
									@endif
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

                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product

                            Description</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <textarea id="description" name="description"

                                      class="form-control col-md-7 col-xs-12 ckeditor"

                                      required>{!! $product->product_description !!}</textarea>

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

                                      required>{{$product->keywords}}</textarea>

                            @if($errors->has('keywords'))

                                <div class="alert alert-danger">

                                    {{$errors->first('keywords')}}

                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="confirmpassword" class="control-label col-md-3 col-sm-3 col-xs-12">Product

                            Image</label>

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

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Actual Price $

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input type="number" id="actualprice" class="form-control col-md-7 col-xs-12" name = "actualprice" value = "{{$product->product_price}}" required />

                          @if($errors->has('actualprice'))

                            <div class="alert alert-danger">

                              {{$errors->first('actualprice')}}

                            </div>

                          @endif

                        </div>

                      </div>

                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Selling Price $ 

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input type="number" id="sellprice" class="form-control col-md-7 col-xs-12" name = "sellprice" value = "{{$product->display_price}}" required />

                          @if($errors->has('sellprice'))

                            <div class="alert alert-danger">

                              {{$errors->first('sellprice')}}

                            </div>

                          @endif

                        </div>

                      </div>

                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Discount (If any) %

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input type="number" id="discount" class="form-control col-md-7 col-xs-12" name = "discount" value = "{{$product->seller_discount}}" required />

                          @if($errors->has('discount'))

                            <div class="alert alert-danger">

                              {{$errors->first('discount')}}

                            </div>

                          @endif

                        </div>

                      </div>

                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Price after discount $ 

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input type="number" id="afterdiscount" class="form-control col-md-7 col-xs-12" name = "afterdiscount" value = "{{$product->price_after_discount}}" readonly required />

                          @if($errors->has('afterdiscount'))

                            <div class="alert alert-danger">

                              {{$errors->first('afterdiscount')}}

                            </div>

                          @endif

                        </div>

                      </div>
					  
					  <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpassword">Status</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <select id="status" class="form-control col-md-7 col-xs-12" name="status">
										<option value="0" <?= ($product->status_value==0)?'selected':'' ?> >Inactive</option>
										<option value="1" <?= ($product->status_value==1)?'selected':'' ?> >Active</option>
                            </select>

                          @if($errors->has('status'))

                            <div class="alert alert-danger">

                              {{$errors->first('status')}}

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