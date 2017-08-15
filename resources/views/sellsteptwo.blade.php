@extends('layouts.buyerdashboardlayout')

@section('content')

        <div class = "box" id="main-box">		             @if(Session::has('attributes_html'))		{!!Session('attributes_html')!!} @else
       <div class="box-heading">Tell us about the Product Attributes...</div>
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" method = "post" action = "{{Request::root()}}/buyerdashboard/sellsteptwo" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                      <div class="parent">
                        <label class="control-label" for="group_name">Group Name</label>
                        <select class="form-control" name="group_name" id="group_name">
                          <option value="">Select Attribute Group</option>
                          @foreach($attribute_groups as $item)
                            <option value="{{$item->id}}">{{$item->attribute_group_name}}</option>
                          @endforeach
                          <option value="Others">Others</option>
                        </select>
                        <div class = "other">
                        </div>
                        <div class="child">

                        </div>
                      </div>
                    </div>

                    <div id="attributes">

                    </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-success" onClick="history.go(-1);return true;">Back</button>
                          <button type="button" onClick="submit_attributes()" class="btn btn-success">Continue</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">                <div class="modal-dialog" role="document">                  <div class="modal-content">                    <div class="modal-header">                      <h5 class="modal-title" id="exampleModalLongTitle">Add Attributes</h5>                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">                        <span aria-hidden="true">&times;</span>                      </button>                    </div>                    <div class="modal-body">                      <form action="" id="form_attributes" method="post" enctype="multipart/form-data">                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                        <div id="0">                        <div class="form-group">                          <label class="control-label" for="input-email">Group Name</label>                          <select id="select_group_name" class="form-control" name="group_name" required>                          </select>                        </div>                        <div class="form-group">                          <a href="#/" onClick="addAttribute()" style="float:right; color:blue;">Add More</a>                          <label class="control-label" for="attribute_name">Attribute Name</label>                          <input type="text" name="attribute_name0" value="" placeholder="Attribute Name" id="attribute_name" class="form-control" required/>                        </div>                        <div class="form-group">                          <label class="control-label" for="input_type">Input Type</label>                          <select class="form-control" name="input_type0" id="input_type" required>                            <option value="Text Box">Text Box</option>                            <option value="Text Area">Text Area</option>                            <option value="Dropdown">Dropdown</option>                            <option value="Option Button">Option Button</option>                          </select>                        </div>                        <div class="form-group">                          <label class="control-label" for="attribute_values">Attribute Options</label>                          <input type="text" class="attribute_values" name="attribute_values0" value="" placeholder="Attribute Options" id="attribute_values" class="form-control"/>                        </div>                      </div>                        <input type="hidden" id="att_num" name="att_num" value="1">                      </form>                    </div>                    <div class="modal-footer">                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                      <button type="button" class="btn btn-primary" onClick="save_attributes()">Save changes</button>                    </div>                  </div>                </div>              </div>
</div>
@endif
<script>

var att_div = 0;

  $('#group_name').change(function(){
    var id = $(this).val();
    var tag = $(this);
    if($(this).val() == 'Others'){
      $('#attributes').html('');
      $(this).next('div.other').html('');
      $(this).next('div.other').html('<input type="text" placeholder="Enter Attribute Group Name" class="form-control" name="new_group_name" id="new_group_name"><br><a href="#/" class="new_group_name success">ADD</a>');
    }
    else{
      $.ajax({
        url:'{{Request::root()}}/buyerdashboard/getAttributes',
        type:'GET',
        data:{'group_id':id},
        success:function(data){
          tag.next('div.other').html('');
          att_div=0;
          $('#attributes').html('');
          $('#attributes').html(data);
        }
      })
    }
  })

  function addMoreAttribute(){
    var content = $('div[attribute_div='+att_div+']').html();
    att_div = att_div+1;
    var html = '<hr><a href="#/" style="float:right; color:blue;" onclick="addMoreAttribute()">Add More</a><div attribute_div="'+att_div+'">';
    html += content;
    html += '</div>'
    $('#attributes').append(html);
    $('div[attribute_div='+att_div+']').children('div').each(function(){
      $(this).find('input[type=radio]').each(function(){
          $(this).prop('name',$(this).prop('name')+"_"+att_div);
          console.log($(this).prop('name'));
      })
    })
  }

  $(document).on('click','.new_group_name',function(){
    if($(this).prevAll('input[type=text]').val() == ''){
      alert('Group Name Cannot be blank');
      return false;
    }
    else{
      var name = $(this).prevAll('input[type=text]').val();
      $.ajax({
        url: '{{Request::root()}}/buyerdashboard/add-attribute-groups',
        type: 'POST',
        data: {'_token':'{{csrf_token()}}', 'gname':$(this).prevAll('input[type=text]').val(),'method_type':'ajax'},
        success: function(data){
          alert('Attribute Group Created, Please add some attributes');
          $('#select_group_name').html('');
          $('#select_group_name').append('<option value="'+data+'">'+name+'</option>')
          $('#myModal').modal('show');
        }
      })
    }
  })

  var num = 1;
  function addAttribute(){
    var html = '<hr><div class="form-group">'+
                  '<a href="#/" onClick="addAttribute()" style="float:right; color:blue;">Add More</a>'+
                  '<label class="control-label" for="attribute_name">Attribute Name</label>'+
                  '<input type="text" name="attribute_name'+num+'" value="" placeholder="Attribute Name" id="attribute_name" class="form-control" required/>'+
                '</div>'+
                '<div class="form-group">'+
                  '<label class="control-label" for="input_type">Input Type</label>'+
                  '<select class="form-control" name="input_type'+num+'" id="input_type" required>'+
                    '<option value="Text Box">Text Box</option>'+
                    '<option value="Text Area">Text Area</option>'+
                    '<option value="Dropdown">Dropdown</option>'+
                    '<option value="Option Button">Option Button</option>'+
                  '</select>'+
                '</div>'+
                '<div class="form-group">'+
                  '<label class="control-label" for="attribute_values">Attribute Options</label>'+
                  '<input type="text" class="attribute_values" name="attribute_values'+num+'" value="" placeholder="Attribute Options" id="attribute_values" class="form-control"/>'+
                '</div>';
      $("#0").append(html);
      $('.attribute_values').tagsInput();
      num += 1;
      $('#att_num').val(num);
  }

  function save_attributes(){
    var group_id = $('#select_group_name').val();
    var name = $('#select_group_name').find(":selected").text();
    $.ajax({
      url:'{{Request::root()}}/buyerdashboard/add-attributes/'+group_id,
      type: 'POST',
      data: $('#form_attributes').serialize(),
      success: function(data){
        $('#group_name').append('<option value="'+group_id+'" selected >'+name+'</option>');
        $('#myModal').modal('hide');
        $('#group_name').change();
      }
    })
  }

  $(document).on('keyup','.discount_value',function(){
    var option = $(this).parent('div').prev('div').children().find('input[type=radio]:checked').val();
    var discount_tag = $(this).parent('div').next('div').children('.after_discount');
    var selling_tag = $(this).parent('div').prev('div').prev('div').children('.price');
    if(option=='percentage'){
      var after_discount = selling_tag.val() - ((selling_tag.val())/100)*$(this).val();
      discount_tag.val(after_discount);
    }
    if(option=='dollar'){
      var after_discount = selling_tag.val() - $(this).val();
      discount_tag.val(after_discount);
    }
  })

  function submit_attributes(){
    var attributes = {};
    var array = {};
    var k=0;
    for(var i=0; i<=att_div; i++){
      k=0;
      array = {};
      $('div[attribute_div='+i+']').children('div').each(function(){
        if($(this).find(':radio').length > 0){
          var att_name = '';
          var value = '';
          if($(this).find('input[type=radio]:checked')){
            att_name = $(this).find('input[type=radio]:checked').attr("name");
            value = $(this).find('input[type=radio]:checked').val();
          }
          var group_id = $('#group_name').val();
        }
        else{
          var att_name = $(this).find('input[attribute="true"]').attr("name");
          var value = $(this).find('input[attribute="true"]').val();
          var group_id = $('#group_name').val();
        }
        array[k] = {'name':att_name, 'value': value, 'group_id': group_id};
        k++;
      })
      attributes[i]=array;
    }
    //console.log(attributes);
    if(Object.keys(attributes[0]).length == 0){
      alert('please add some attributes to your product');
    }
    else{
      //console.log(JSON.stringify(attributes));
      var json = JSON.stringify(attributes);	  $("input").each(function(){		           $(this).attr("value", $(this).val());		       });		      $('[type=checkbox], [type=radio]').each(function(){ this.defaultChecked = this.checked; });		      $('select option').each(function(){ this.defaultSelected = this.selected; });		      var content_html = $('#main-box').html();		      //console.log(content);
      //return false;
      $.ajax({
        url:'{{Request::root()}}/buyerdashboard/sellsteptwo',
        type:'POST',
        data: {"form":json,"_token":"{{csrf_token()}}","content":content_html},
        success: function(data){
          if(data=='success'){
            alert('Details saved!! Please continue...');
            window.location.href = "{{Request::root()}}/buyerdashboard/sellstepthree";
          }
          else{
            alert('Please Fill Out all Fields');
            return false;
          }
        }
      })
    }
  }
</script>


@stop
