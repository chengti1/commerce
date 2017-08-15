@extends('layouts.buyerdashboardlayout')
@section('content')
<div class = "box">
	<div class="box-heading">Add Attributes</div>
		<div class="right_col" role="main">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
              <form action="{{Request::root()}}/buyerdashboard/add-attributes/{{$attribute_group->id}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div id="0">
                <div class="form-group">
                  <label class="control-label" for="input-email">Group Name</label>
                  <select class="form-control" name="group_name" required>
                    <option value="{{$attribute_group->id}}">{{$attribute_group->attribute_group_name}}</option>
                  </select>
                </div>

                <div class="form-group">
                  <a href="#/" onClick="addAttribute()" style="float:right; color:blue;">Add More</a>
                  <label class="control-label" for="attribute_name">Attribute Name</label>
                  <input type="text" name="attribute_name0" value="" placeholder="Attribute Name" id="attribute_name" class="form-control" required/>
                </div>

                <div class="form-group">
                  <label class="control-label" for="input_type">Input Type</label>
                  <select class="form-control" name="input_type0" id="input_type" required>
                    <option value="Text Box">Text Box</option>
                    <option value="Text Area">Text Area</option>
                    <option value="Dropdown">Dropdown</option>
                    <option value="Option Button">Option Button</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label" for="attribute_values">Attribute Options</label>
                  <input type="text" class="attribute_values" name="attribute_values0" value="" placeholder="Attribute Options" id="attribute_values" class="form-control"/>
                </div>

              </div>
                <input type="hidden" id="att_num" name="att_num" value="1">
                <br><input type="submit" value="Submit" class="btn btn-primary" />
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
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
</script>
@stop
