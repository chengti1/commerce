@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box">
       <div class="box-heading">Tell us about the shipping...</div>
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/buyerdashboard/sellstepthree" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Select Countries you Ship From</label>
                          <select class="form-control chosen" id="from" name="from" required>
                            @foreach($countries as $country)
                              <option value="{{$country->from_country}}" >{{$country->from_country}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Select Countries you Ship To</label>
                          <select class="form-control chosen" name="to[]" id="to" multiple required>

                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Weight (Lbs)</label>
                          <input type="number" class="form-control" name="weight" placeholder="Weight" required>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button name = "submit" class="btn btn-cancel" onClick="history.go(-1);return true;">Back</button>
                          <button type="submit" name = "submit" class="btn btn-success">Continue</button>

                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>

<link rel="stylesheet" type="text/css" href="{{Request::root()}}/css/chosen.min.css">

<script type="text/javascript" src="{{Request::root()}}/js/chosen.jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
      $('#to').chosen();
    })

    $('#from').change(function(){
      $.ajax({
        url:'{{Request::root()}}/buyerdashboard/getToShipping',
        type:'POST',
        data:{'from':$('#from').val(),'_token':'{{csrf_token()}}'},
        success:function(data){
          $("#to").html(data).chosen().trigger("chosen:updated");
        }
      })
    })

    function show(){
          var radioValue = $("input[name='discount_type']:checked").val();
            if(radioValue){
              $("#totalpayee").html(radioValue);
              var sellprice = parseInt($('#sellprice').val());
              var discount = parseInt($('#discount').val());
              if(radioValue == "$")
                {
                  //validating discount in $ can't be greater than sellprice
                     if(discount > sellprice)
                     {
                         var discount = 0;
                         var dprice = 0;

                         $('#afterdiscount').val(dprice);

                         alert("you cannot discount more than sellprice."+sellprice);


                     }
                    else
                     {
                         var dprice = sellprice - discount;
                     }
                    //validating discount in $ can't be greater than sellprice

                     $('#afterdiscount').val(dprice);
                }
                else
                {
                    //validating discount in % can't be greater than 100 %
                    var dprice = (sellprice) - (sellprice / 100) * discount;
                     if(discount >= 100)
                    {
                        var discount = 0;
                        var dprice = 0;
                        $('#afterdiscount').val(dprice);

                        alert("you cannot discount more than 100 % .");


                    }
                    else
                    {
                      var dprice = (sellprice) - (sellprice / 100) * discount;
                      $('#afterdiscount').val(dprice);

                    }
                }
            }
       }
</script>
<!-- Prashant Kumar -->

@stop
