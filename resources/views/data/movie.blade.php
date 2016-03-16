@extends('layouts.app')

@section('title', $movie->getTitle())

@inject('image', 'Tmdb\Helper\ImageHelper')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-4">
    		{!! $image->getHtml($movie->getPosterImage(), 'w780', '100%') !!}
    	</div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $movie->getTitle() }}</div>

                <div class="panel-body">
                	{{$movie->getOverview()}}
                </div>
             </div>

             <div class="panel panel-default">
             	<div class="panel-heading">Cast</div>

                <div class="panel-body">
                <ul>
                    @foreach ($movie->getCredits()->getCast() as $person) 
						<li> {{$person->getName()}} as {{$person->getCharacter()}}</li>
					@endforeach
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection