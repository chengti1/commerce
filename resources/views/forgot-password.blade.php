@extends('layouts.layout')





@section('content')





<!-- BREADCRUMB


  ================================================== -->


<div class="breadcrumb full-width">


  <div class="background-breadcrumb"></div>


  <div class="background">


    <div class="shadow"></div>


    <div class="pattern">


      <div class="container">


        <div class="clearfix">


          <h1 id="title-page">Forgot Password                     </h1>


          


          <ul>


                        <li><a href="{{Request::root()}}">Home</a></li>


                        <li><a href="{{Request::root()}}/forgot-password">Forgot Password</a></li>


                      </ul>


        </div>


      </div>


    </div>


  </div>


</div>





<!-- MAIN CONTENT


  ================================================== -->


<div class="main-content full-width inner-page">

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



  <div class="background-content"></div>


  <div class="background">


    <div class="shadow"></div>


    <div class="pattern">


      <div class="container">


                        


                


        <div class="row">


                    


                    <div class="col-sm-12">


                        


                        


            <div class="row">


                            <div class="col-sm-12 center-column">





                                                                  


                                                  


<div class="row">


  <div class="div-center">


  <div class="col-sm-6" style="float:none;margin:0 auto;">


    <div class="well">


      <form action="forgot-password" method="post" enctype="multipart/form-data">


      <input type="hidden" name="_token" value="{{ csrf_token() }}">


        <div class="form-group">


          <label class="control-label" for="input-email">E-Mail Address</label>


          <input type="email" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" required/>


        </div>


        <input type="submit" value="Submit" class="btn btn-primary" />


              </form>


    </div>


  </div>

  </div>


</div>





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





@stop