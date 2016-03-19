@extends('layouts.app')

@section('title', 'Popular Movies')

@section('content')
<div class="container">
    @inject('image', 'Tmdb\Helper\ImageHelper')

    <div class="row row-margin-bottom">
        @foreach ($movies as $movie)
            <div class="col-sm-5 col-sm-offset-1 no-padding no-link lib-item" data-category="view">
                <a href="/movie/{{ $movie->getId() }}">
                    <div class="lib-panel">
                        <div class="row box-shadow">
                            <div class="col-md-6 col-sm-12">
                                {!! $image->getHtml($movie->getPosterImage(), 'w780', '100%') !!}
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
@endsection