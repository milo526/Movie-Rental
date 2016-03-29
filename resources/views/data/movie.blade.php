@extends('layouts.app')

@section('title', $movie->getTitle())

@inject('image', 'Tmdb\Helper\ImageHelper')

@section('content')
<div class="container">
    <div class="alert alert-success alert-dismissible hidden" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Succes!</strong> We added {{$movie->getTitle()}} to your shopping cart.
    </div>
    <div class="row fluid">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $image->getHtml($movie->getPosterImage(), 'w780', '100%', '100%', 'poster_large') !!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">{{ $movie->getTitle() }}</div>
                <table class="table">
                    <tr><td><b>Rating</b></td><td>{{$movie->getVoteAverage()}}</td></tr>
                    <tr><td><b>Release date</b></td><td>{{$movie->getReleaseDate()->format('d-m-y')}}</td></tr>
                    @if ($movie->getBudget() > 0)
                        <tr><td><b>Budget</b></td><td>${{number_format($movie->getBudget())}}</td></tr>
                    @endif
                    @if ($movie->getRevenue() > 0)
                        <tr><td><b>Revenue</b></td><td>${{number_format($movie->getRevenue())}}</td></tr>
                    @endif
                </table>
            </div>
            @if (!Auth::guest())
                <button id="rent-button" class="btn btn-primary btn-lg btn-block" onclick="rent({{$movie->getId()}})">Rent</button>
            @else
                <button class="btn btn-danger btn-lg btn-block" disabled="disabled">Login to rent</button>
            @endif
        </div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="panel-title">{{ $movie->getTitle() }}: <small>@if($movie->getTagLine()) {{$movie->getTagLine()}} @endif</small></h4></div>

                <div class="panel-body">
                    {{$movie->getOverview()}}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Cast</div>

                <div class="panel-body">
                    <div class="row row-horizon"> 
                        @foreach ($movie->getCredits()->getCast() as $person)
                            <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
                                <a href="/actor/{{$person->getID()}}">
                                    {!! $image->getHtml($person->getProfileImage(), 'w500', '100%', '100%', 'person') !!}
                                    {{$person->getName()}} as {{$person->getCharacter()}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Crew</div>

                <div class="panel-body">
                    <div class="row row-horizon"> 
                        @foreach ($movie->getCredits()->getCrew() as $person)
                            <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
                                <a href="/crew/{{$person->getID()}}">
                                    {!! $image->getHtml($person->getProfileImage(), 'w500', '100%', '100%', 'person') !!}
                                    {{$person->getName()}} {{$person->getJob()}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if($movie->getVideos())
            <div class="panel panel-default">
                <div class="panel-heading">Videos</div>

                <div class="panel-body">
                    <div class="row row-horizon"> 
                        @foreach ($movie->getVideos() as $video)
                            <div class="col-sm-12 col-md-6">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$video->getKey()}}" allowfullscreen></iframe>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script src="{{ elixir('js/rent.js') }}"></script>
@endsection