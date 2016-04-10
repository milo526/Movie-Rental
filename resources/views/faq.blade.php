@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="container">
    @foreach($categories as $category)
        <h2>{{$category->title}}</h2>
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
    @endforeach
{{--
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="--HEADING--">
<h4 class="panel-title">
<a class="collapsed" role="button" data-toggle="collapse" data-parent="#faq" href="#--ITEM--" aria-expanded="false" aria-controls="--ITEM--">
--QUESTION--
</a>
</h4>
</div>
<div id="--ITEM--" class="panel-collapse collapse" role="tabpanel" aria-labelledby="--HEADING--">
<div class="panel-body">
--ANWSER--
</div>
</div>
</div>
--}}

<br />
<br />
</div>

@include('layouts.footer')
@endsection