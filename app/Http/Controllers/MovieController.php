<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;

class MovieController extends Controller{

	private $movies;

	public function __construct(MovieRepository $movies, ImageHelper $helper){
        $this->movies = $movies;
    }

    function index($id)
    {
        // returns information of a movie
        $movie = $this->movies->load($id);
        return view('data/movie')->with('movie', $movie);
    }

    function get()
    {
        return $movies;
    }
}
