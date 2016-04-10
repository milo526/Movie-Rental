@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')

<script type="text/javascript">
    var token = "{{csrf_token()}}";
</script>

<div class="container">
	<div class="row">

        @if($errors->has())
           @foreach ($errors->all() as $error)
              <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                {{$error}}
            </div>
          @endforeach
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
			<div class="panel panel-primary" name="basket">
                <div class="panel-heading">In Basket</div>
                @if(count(Auth::User()->basketRentals)>0)
                <table class="table table-striped">
                	<tr><th>Title</th><th>Rent date</th><th></th></tr>
                    @foreach(Auth::User()->basketRentals as $rental)
                    	<tr id="basket{{$rental->id}}">
                    		<td>{{$rental->getMovie()->getTitle()}}</td>
                    		<td>{{$rental->date()->format('d-m-y')}}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <button type="button" id="invoice{{$rental->id}}" class="btn btn-primary" onclick="addToInvoice({{$rental->id}})">Add to invoice</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="disabled"><a href="#">Remove from account</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#" onclick="removeRent({{$rental->id}})">Remove from basket</a></li>
                                    </ul>
                                </div>
                            </td>
                    	</tr>
                    @endforeach
                </table>
                @else
                <div class="panel-body text-center">
                    Whoops your basket is empty!<br />
                    Go <a href="{{route('index')}}">Shop</a>
                </div>
                @endif
                <div class="panel-footer" id="invoiceFooter" style="display: none;"><a id="createInvoiceButton" class="btn btn-default btn-lg btn-block" onclick="createInvoice()">Create Invoice</a></div>
            </div>
            @if(count(Auth::user()->unpayedInvoices)>0)
            <div class="panel panel-danger">
                <div class="panel-heading panel">Unpayed Invoices</div>
                <table class="table-invoice table table-striped">
                    <tr><th>ID</th><th>Date</th><th>Payed</th><th></th></tr>
                    @foreach(Auth::User()->unpayedInvoices as $invoice)
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->date()->format('d-m-y')}}</td>
                            <td><span class="glyphicon glyphicon-ok text-warning" aria-hidden="true"></span></td>
                            <td class="text-right">
                                {{Form::open(['route' => ['profile::payInvoice', $invoice->id]])}}
                                <div class="btn-group" role="group">
                                    <a href="{{route('profile::invoice', ['id'=> $invoice->id])}}" class="btn btn-info" role="button">Show</a>
                                    <input type="submit" class="btn btn-primary" value="Pay">
                                </div>
                                {{Form::close()}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @endif

            @if(count(Auth::user()->payedInvoices)>0)
            <div class="panel panel-primary">
                <div class="panel-heading panel">Invoices</div>
                <table class="table-invoice table table-striped">
                	<tr><th>ID</th><th>Date</th><th>Payed</th><th></th></tr>
                    @foreach(Auth::User()->payedInvoices as $invoice)
                    	<tr>
                    		<td>{{$invoice->id}}</td>
                    		<td>{{$invoice->date()->format('d-m-y')}}</td>
                			<td><span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span></td>
                            <td class="text-right">
                                <div class="btn-group" role="group">
                                    <a href="{{route('profile::invoice', ['id'=> $invoice->id])}}" class="btn btn-info" role="button">Show</a>
                                </div>
                            </td>
                    	</tr>
                    @endforeach
                </table>
            </div>
            @endif
		</div>
	</div>
</div>
<script src="{{ elixir('js/profile.js') }}"></script>
@endsection