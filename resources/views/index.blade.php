@extends('layouts.app')

@section('title', 'Popular Movies')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>
    @inject('image', 'Tmdb\Helper\ImageHelper')

    @foreach ($movies as $movie)
        <a href="/movie/{{$movie->getId()}}">
            {!! $image->getHtml($movie->getPosterImage(), 'w780', 260, 420) !!}
        </a>
    @endforeach
        
</div>
@endsection