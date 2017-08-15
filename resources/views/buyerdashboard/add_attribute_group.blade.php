@extends('layouts.buyerdashboardlayout')
@section('content')
<div class = "box">
	<div class="box-heading">Add Attribute Groups</div>
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
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label class="control-label" for="input-email">Group Name</label>
                  <input type="text" name="gname" value="{{old('gname')}}" placeholder="Group Name" id="gname" class="form-control" required/>
                </div>
                @if(!EMPTY($errors->first('gname')))
                  <div class="alert alert-danger">
                    {{$errors->first('gname')}}
                  </div>
                @endif
                <input type="submit" value="Submit" class="btn btn-primary" />
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
