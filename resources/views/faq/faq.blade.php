@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="container">
    @role('admin')
        <div class="row">
            <div class="col-sm-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> {{session('status')}}
                    </div>
                @endif
            </div>
        </div>
    @endrole
    <div class="row">
    @foreach($categories as $category)
        <div class="panel panel-default">
            <div class="panel-heading">
                 <h3 class="panel-title pull-left">
                    {{$category->title}}
                </h3>
                @permission('create.faq')
                    <div class="btn-group pull-right" role="group" aria-label="Basic example">
                        <a href="{{route('faq::create', ['id'=>$category->id])}}" class="btn btn-primary">New</a>
                        <a href="{{route('faq::category::edit', ['id'=>$category->id])}}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                    </div>
                @endpermission
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                @forelse($category->questions as $item)
                    <div class="panel-group" id="faq" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="{{$item->id}}-Heading">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#faq" href="#{{$item->id}}" aria-expanded="false" aria-controls="{{$item->id}}">
                                        {{$item->question}}
                                    </a>
                                </h4>
                            </div>
                            <div id="{{$item->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$item->id}}-Heading">
                                <div class="panel-body">
                                    <blockquote>
                                    {!!html_entity_decode($item->anwser)!!}
                                    <footer>{{$item->user->name}}</footer>
                                    </blockquote>
                                     @permission('edit.faq')
                                        <a href="{{route('faq::edit', ['id'=>$item->id])}}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> update</a>
                                    @endpermission
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning!</strong> {{$category->title}} has no FAQ items.
                    </div>
                @endforelse
                </div>
        </div>
    @endforeach
    </div>
    <br />
    <br />
</div>

@include('layouts.footer')
@endsection