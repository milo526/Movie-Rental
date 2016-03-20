@extends('layouts.app')

@section('title', $movie->getTitle())

@inject('image', 'Tmdb\Helper\ImageHelper')

@section('content')
<div class="container">
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
                <form action="/profile/rent/{{$movie->getId()}}" method="POST">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Rent"></input>
                </form>
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
        </div>
    </div>
</div>
@endsection