@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="container">
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
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                @if(isset($category))
                    Edit Category
                @else
                    Create Category
                @endif</div>
                    <div class="panel-body">
                        @if(isset($category))
                        <form id="contact" method="post" class="form" role="form" action="{{route('faq::category::postEdit', ['id'=> $category->id])}}" method="post">
                        @else
                        <form id="contact" method="post" class="form" role="form" action="{{route('faq::category::make')}}">
                        @endif
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <label for="question">Category:</label>
                                <input class="form-control" id="title" name="title" placeholder="Title" type="text" value="@if(isset($category)){{$category->title}}@else{{old('title')}}@endif" required autofocus />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                                    <a href="{{route('faq::index')}}" class="btn btn-danger" >Cancel</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection