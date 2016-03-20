@extends('layouts.app')

@section('title', $person->getName())

@inject('image', 'Tmdb\Helper\ImageHelper')

@section('content')
<div class="container">
    <div class="row fluid">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $image->getHtml($person->getProfileImage(), 'w780', '100%', '100%', 'person_large') !!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">{{ $person->getName() }}</div>
                <table class="table">
                    <tr><td><b>Birthday</b></td><td>{{$person->getBirthday()->format('d-m-y')}}</td></tr>
					@if ($person->getDeathday())
                        <tr><td><b>Death</b></td><td>{{$person->getDeathday()->format('d-m-y')}}</td></tr>
                    @endif
                    @if (count($person->getAlsoKnownAs()) > 0)
						<tr><td><b>Alias</b></td><td>@foreach($person->getAlsoKnownAs() as $alias) {{$alias}}, @endforeach</td></tr>
					@endif
                </table>
            </div>
        </div>
        <div class="col-sm-8">

            <div class="panel panel-default">
                <div class="panel-heading">Biography</div>

                <div class="panel-body">
                    {{$person->getBiography()}}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Movies</div>

                <div class="panel-body">
                    <div class="row row-horizon"> 
                        @foreach ($person->getMovieCredits()->getCast() as $castMember)
                            <div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
                                <a href="/movie/{{$castMember->getID()}}">
                                    {!! $image->getHtml($castMember->getPosterImage(), 'w500', '100%', '100%', 'poster') !!}
                                    {{$castMember->getCharacter()}}
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