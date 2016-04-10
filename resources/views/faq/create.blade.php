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
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create FAQ Item</div>
                <div class="panel-body">
                    @if(isset($data['update']) && $data['update']===true)
                    <form id="contact" method="post" class="form" role="form" action="{{route('faq::postEdit', ['id'=> $data['id']])}}" method="post">
                    @else
                    <form id="contact" method="post" class="form" role="form" action="{{route('faq::make')}}">
                    @endif
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-6 col-md-6 form-group">
                                <label for="question">Question:</label>
                                <input class="form-control" id="question" name="question" placeholder="Question" type="text" value="@if(isset($data['question'])){{$data['question']}}@else{{old('question')}}@endif" required autofocus />
                            </div>
                            <div id="category_select" class="col-xs-6 col-md-6 form-group">
                                <label for="category">Category:</label>
                                <select class="form-control" name="category" id="category">
                                <option value="">Select...</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                    @if(isset($data['categoryID']))
                                        @if($category->id == $data['categoryID'])
                                            selected
                                        @endif
                                    @else
                                        @if($category->id == old('category'))
                                            selected
                                        @endif
                                    @endif
                                    >{{$category->title}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <textarea class="form-control" id="anwser" name="anwser" placeholder="Anwser" rows="5">@if(isset($data['anwser'])){{$data['anwser']}}@else{{old('anwser')}}@endif</textarea>
                        <br />
                        <div class="row">
                            <div class="col-xs-12 col-md-12 form-group">
                                <button class="btn btn-primary pull-right" type="submit">Submit</button>
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