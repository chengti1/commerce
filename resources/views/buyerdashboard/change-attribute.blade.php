@extends('layouts.buyerdashboardlayout')
@section('content')
<div class = "box">
	<div class="box-heading">Change Attributes</div>
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
              <form action="{{Request::root()}}/buyerdashboard/change-attribute/{{$attributes->id}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div id="0">

                <div class="form-group">
                  <label class="control-label" for="attribute_name">Attribute Name</label>
                  <input type="text" name="attribute_name" value="{{$attributes->attribute_name}}" placeholder="Attribute Name" id="attribute_name" class="form-control" required/>
                </div>

                <div class="form-group">
                  <label class="control-label" for="input_type">Input Type</label>
                  <select class="form-control" name="input_type" id="input_type" required>
                    <option value="Text Box" <?= ($attributes->type == "Text Box")?"selected":"" ?>>Text Box</option>
                    <option value="Text Area" <?= ($attributes->type == "Text Area")?"selected":"" ?>>Text Area</option>
                    <option value="Dropdown" <?= ($attributes->type == "Dropdown")?"selected":"" ?>>Dropdown</option>
                    <option value="Option Button" <?= ($attributes->type == "Option Button")?"selected":"" ?>>Option Button</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label" for="attribute_values">Attribute Options</label>
                  <input type="text" class="attribute_values" name="attribute_values" value="{{$attributes->value}}" placeholder="Attribute Options" id="attribute_values" class="form-control"/>
                </div>

              </div>
                <br><input type="submit" value="Submit" class="btn btn-primary" />
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
