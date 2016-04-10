@extends('layouts.app')

@section('title', 'Search: '.$query)

@inject('image', 'Tmdb\Helper\ImageHelper')

@section('content')

@if(isset($movies))
<div class="col-xs-12">
	<h1 class="text-center">Movies</h1>
	<div class="row row-horizon"> 
	    @forelse ($movies as $movie)
	        <div class="col-xs-8 col-sm-4 col-md-3 col-lg-2">
	            <a href="/movie/{{$movie->getID()}}">
	                <div class="thumbnail">
	                    {!! $image->getHtml($movie->getPosterImage(), 'w780', '100%', '100%', 'poster_large') !!}
	                    <div class="caption">
	                        <h4>{{$movie->getTitle()}}</h4>
	                    </div>
	                </div>
	            </a>
	        </div>
	    @empty
	    @endforelse
	</div>
</div>
@endif

@if(isset($persons))
<div class="col-xs-12">
	<h1>Persons</h1>
	<div class="row row-horizon"> 
	    @forelse ($persons as $person)
	        <div class="col-xs-8 col-sm-4 col-md-3 col-lg-2">
	            <a href="/actor/{{$person->getID()}}">
	                <div class="thumbnail">
	                    {!! $image->getHtml($person->getProfileImage(), 'w500', '100%', '100%', 'person') !!}
	                    <div class="caption">
	                        <h4>{{$person->getName()}}</h4>
	                    </div>
	                </div>
	            </a>
	        </div>
	    @empty
	    @endforelse
	</div>
</div>
@endif

@endsection