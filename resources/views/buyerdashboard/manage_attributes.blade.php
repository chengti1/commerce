@extends('layouts.buyerdashboardlayout')
@section('content')
<div class = "box">
	<div class="box-heading">Manage Attributes</div>
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
									<thead>
										<tr class="headings">
											<th class="column-title">Attribute Name</th>
                      <th class="column-title">Input Type</th>
											<th class="column-title">Values</th>
											<th class="column-title">Edit</th>
                      <th class="column-title">Delete</th>
										</tr>
									</thead>
									<tbody>
										@foreach($attributes as $item)
											<tr>
												<td class="column-title">{{$item->attribute_name}}</td>
                        <td class="column-title">{{$item->type}}</td>
												<td class="column-title">{{$item->value}}</td>
												<td class="column-title"><a href="{{Request::root()}}/buyerdashboard/change-attribute/{{$item->id}}"<button class="btn btn-success">Edit</button></td>
                        <td class="column-title"><a href="{{Request::root()}}/buyerdashboard/delete-attributes/{{$item->id}}"<button class="btn btn-success">Delete</button></td>
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
