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
                <div class="panel-heading panel">Rented</div>
                <table class="table table-striped">
                		<tr><th>Title</th><th>Rent date</th><th>Payed</th></tr>
                    @foreach(Auth::User()->rentals as $rental)
                    	<tr><td>{{$rental->getMovie()->getTitle()}}</td><td>{{$rental->date()->format('d-m-y')}}</td></tr>
                    @endforeach
                </table>
            </div>
		</div>
	</div>
</div>

@endsection