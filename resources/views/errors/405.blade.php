@extends('layouts.app')

@section('title', 'Not found!')

@section('content')
<style type="text/css">
	.error-template {padding: 40px 15px;text-align: center;}
	.error-actions {margin-top:15px;margin-bottom:15px;}
	.error-actions .btn { margin-right:10px; }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    405 Method not allowed</h2>
                <div class="error-details">
                    Sorry, an error has occured, your request method is not allowed!
                </div>
                <div class="error-actions">
                    <a href="{{route('index')}}" class="btn btn-primary btn-lg">
                    	<span class="glyphicon glyphicon-home"></span> Take Me Home
                    </a>
                    <a href="javascript:history.back()" class="btn btn-default btn-lg">
                    <span class="glyphicon glyphicon-chevron-left"></span> Go back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection