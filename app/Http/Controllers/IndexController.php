<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\MovieRepository;

class IndexController extends Controller
{
    private $movies;

    private $popular;

    public function __construct(MovieRepository $movies, ImageHelper $helper)
    {
        $this->movies = $movies;
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $popular = $this->movies->getPopular();

        return view('index')->with('movies', $popular);
    }
}
