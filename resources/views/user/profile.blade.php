@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')

<div class="container">
	<div class="row">
		@if(isset($rental))
			<div class="alert alert-success alert-dismissible" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  				Succesfully rented {{$rental->getMovie()->getTitle()}}
			</div>
		@endif
		<div class="col-md-4 col-sm-6">
			<div class="col-xs-12">
				<h2 class="text-primary">Contact</h2>
				<table class="table table-striped">
					<tr>
						<th>Name:</th>
						<td>{{Auth::User()->name}}</td>
					</tr>
					<tr>
						<th>Email:</th>
						<td>{{Auth::User()->email}}</td>
					</tr>

				</table>
			</div>
		</div>

		<div class="col-md-8 col-sm-6">
			<div class="panel panel-primary">
                <div class="panel-heading">In Basket</div>
                <table class="table table-striped">
                	<tr><th>Title</th><th>Rent date</th><th>Payed</th><th></th></tr>
                    @foreach(Auth::User()->basketRentals as $rental)
                    	<tr>
                    		<td>{{$rental->getMovie()->getTitle()}}</td>
                    		<td>{{$rental->date()->format('d-m-y')}}</td>
                    		@if($rental->invoice)
                    			@if($rental->isPayed())
                    				<td><span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span></td>
                    			@else
                    				<td><span class="glyphicon glyphicon-ok text-warning" aria-hidden="true"></span></td>
                    			@endif
                    		@else
                    				<td><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span></td>
                    		@endif
                            <td>
                                <div class="btn-group">
                                    <button type="button" id="rental{{$rental->id}}" class="btn btn-primary" onclick="addToInvoice({{$rental->id}})">Add to invoice</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" disabled="disabled">Remove from account</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Remove from basket</a></li>
                                    </ul>
                                </div>
                            </td>
                    	</tr>
                    @endforeach
                </table>
                <div class="panel-footer" id="invoiceFooter" style="display: none;"><a id="createInvoiceButton" class="btn btn-default btn-lg btn-block">Create Invoice</a><a id="payInvoiceButton" class="btn btn-success btn-lg btn-block">Pay Invoice</a></div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading panel">Invoices</div>
                <table class="table table-striped">
                	<tr><th>ID</th><th>Date</th><th>Payed</th></tr>
                    @foreach(Auth::User()->invoices as $invoice)
                    	<tr>
                    		<td>{{$invoice->id}}</td>
                    		<td>{{$invoice->date()->format('d-m-y')}}</td>
                			@if($invoice->payed)
                				<td><span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span></td>
                			@else
                				<td><span class="glyphicon glyphicon-ok text-warning" aria-hidden="true"></span></td>
                			@endif
                    	</tr>
                    @endforeach
                </table>
            </div>
		</div>
	</div>
</div>
<script src="{{ elixir('js/profile.js') }}"></script>
@endsection