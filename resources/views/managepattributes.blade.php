@extends('layouts.buyerdashboardlayout')
@section('content')
<div class = "box">
	<div class="box-heading">Manage Product Attributes</div>
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
							@if(!EMPTY(Session('error')))
								<div class="alert alert-danger">
									{{Session('error')}}
								</div>
							@endif
							@if(!EMPTY(Session('success')))
								<div class="alert alert-success">
									{{Session('success')}}
								</div>
							@endif
							<div class="table-responsive">
								<table class="table table-striped jambo_table bulk_action">
									<a href="{{Request::root()}}/buyerdashboard/add-attribute-groups"<button class="pull-right btn btn-success">ADD</button></a>
									<thead>
										<tr class="headings">
											<th class="column-title">Attribute Group</th>
											<th class="column-title">Add Attributes</th>
											<th class="column-title">Manage Attributes</th>
										</tr>
									</thead>
									<tbody>
										@foreach($attribute_groups as $item)
											<tr>
												<td class="column-title">{{$item->attribute_group_name}}</td>
												<td class="column-title"><a href="{{Request::root()}}/buyerdashboard/add-attributes/{{$item->id}}"<button class="btn btn-success">Add</button></td>
												<td class="column-title"><a href="{{Request::root()}}/buyerdashboard/manage-attributes/{{$item->id}}"<button class="btn btn-success">Manage</button></td>
											<tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
