@extends('layouts/admin_layout')

@section('title', 'Admin Permissions')

@section('content')
<div class="container">
	{{-- Manage permissions from users --}}
    <div class="row">
    	@if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{session('status')}}
            </div>
        @endif
    	<div class="col-md-6">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				{{$user->name}}
    			</div>
    			<div class="panel-body">
    				@if($user->roles->count()>0)
	    				<b>Roles:</b>
	    				<ul>
    				@endif
					@forelse($user->roles as $role)
						<li>{{$role->name}}</li>
					@empty
						<div class="alert alert-danger">
			                Oops, this user has no roles yet!
			            </div>
					@endforelse
					@if($user->roles->count()>0)
	    				</ul>
	    			@endif
    			</div>
    		</div>
    	</div>
    	<div class="col-md-6">
	    	<div class="panel panel-primary">
    			<div class="panel-heading">
    				Add Role
    			</div>
    			<div class="panel-body">
                    <form id="contact" method="post" class="form" role="form" action="{{route('admin::permissions::edit', ['id'=> $user->id])}}" method="post">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-1">
                                <label for="role">Role:</label>
                        	</div>
                            <div id="category_select" class="col-xs-9 form-group">
                                <select class="form-control" name="role" id="role">
                                <option value="">Select...</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-xs-2 form-group">
                                <button class="btn btn-primary pull-right" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
    			</div>
    		</div>
    	</div>
		@if($user->roles->count()>0)
    	<div class="col-md-6">
	    	<div class="panel panel-danger">
    			<div class="panel-heading">
    				Remove Role
    			</div>
    			<div class="panel-body">
                    <form id="contact" method="post" class="form" role="form" action="{{route('admin::permissions::edit', ['id'=> $user->id])}}" method="post">
                    {{ csrf_field() }}
                        <div class="row">
                        	<div class="col-xs-1">
                                <label for="role">Role:</label>
                        	</div>
                            <div id="category_select" class="col-xs-9 form-group">
                                <select class="form-control" name="role" id="role">
                                <option value="">Select...</option>
                                @foreach($user->roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-xs-2 form-group">
                                <button class="btn btn-primary pull-right" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
    			</div>
    		</div>
    	</div>
    	@endif
    </div>
</div>
@endsection