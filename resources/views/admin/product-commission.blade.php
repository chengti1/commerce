@extends('admin.layouts.admindashboardlayout')
@section('content')
	<!-- page content -->
	<div class="right_col" role="main">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Manage Product Commission</h2>
						<div class="x_content">

							<div class="table-responsive">
								<table class="table table-striped jambo_table bulk_action">
									<thead>
										<tr class="headings">
											<th class="column-title">S.No.</th>
											<th class="column-title">Commission Precentage</th>
											<th class="column-title">Fixed Commission</th>
											<th class="column-title">Maximum Commission</th>
											<th class="column-title">Category</th>
											<th class="column-title">Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($commission as $commissions)
											<tr>
												<td>{{ $commissions->id }}</td>
												<td>{{ $commissions->percentage }}%</td>
												<td>{{ $commissions->fixed }} USD</td>
												<td>{{ $commissions->category->category_name }} USD</td>
												<td></td>
												<td></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
