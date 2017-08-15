@extends('layouts.layout')



@section('content')

<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<!-- BREADCRUMB

	================================================== -->

<div class="breadcrumb full-width">

	<div class="background-breadcrumb"></div>

	<div class="background">

		<div class="shadow"></div>

		<div class="pattern">

			<div class="container">

				<div class="clearfix">

					<h1 id="title-page">Order Summary											</h1>

					

					<ul>

												<li><a href="{{Request::root()}}">Home</a></li>

												

												<li>Order Summary</li>

											</ul>

				</div>

			</div>

		</div>

	</div>

</div>



<!-- MAIN CONTENT

	================================================== -->

<div class="main-content full-width inner-page">

	<div class="background-content"></div>

	<div class="background">

		<div class="shadow"></div>

		<div class="pattern">
		
<div class="container">
{!! $invoice !!}
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