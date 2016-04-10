@extends('layouts.app')

@section('title', 'Popular Movies')

@section('content')
<div class="container">
    @inject('image', 'Tmdb\Helper\ImageHelper')
    <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-btn fa-fire"></i>Hot Movies</div>
        <div class="panel-body">
            <div class="row row-margin-bottom row-horizon">
                @foreach ($movies as $movie)
                    <div class="col-sm-5 no-link lib-item" data-category="view">
                        <a href="/movie/{{ $movie->getId() }}">
                            <div class="lib-panel">
                                <div class="row box-shadow">
                                    <div class="col-md-6 col-sm-12">
                                        {!! $image->getHtml($movie->getPosterImage(), 'w780', '100%', '100%', 'poster_large') !!}
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="lib-row lib-header">
                                            {{$movie->getTitle()}}
                                            <div class="lib-header-seperator"></div>
                                        </div>
                                        <div class="lib-row lib-desc">
                                            {{ str_limit($movie->getOverview(), $limit = 120, $end = '...') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
        
</div>
@include('layouts.footer')
@endsection