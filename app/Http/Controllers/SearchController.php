<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\SearchRepository;
use Tmdb\Model\Search\SearchQuery\KeywordSearchQuery;
use Tmdb\Model\Search\SearchQuery\MovieSearchQuery;
use Tmdb\Model\Search\SearchQuery\PersonSearchQuery;

class SearchController extends Controller{

	private $search;

	public function __construct(SearchRepository $search, ImageHelper $helper){
        $this->search = $search;
        
    }

    function searchMulti($searchQuery, $page = 1)
    {
        $movies = $this->getMovies($searchQuery, $page);
        $persons = $this->getPersons($searchQuery, $page);
        return view('data/search')->with('movies', $movies)->with('persons', $persons)->with('query', $searchQuery);
    }

    function searchMovie($searchQuery, $page = 1)
    {
        $movies = $this->getMovies($searchQuery, $page);
        return view('data/search')->with('movies', $movies)->with('query', $searchQuery);
    }

    function searchPerson($searchQuery, $page = 1)
    {
        $persons = $this->getPersons($searchQuery, $page);
        return view('data/search')->with('persons', $persons)->with('query', $searchQuery);
    }

    function getPersons($searchQuery, $page = 1){
        $query = new \Tmdb\Model\Search\SearchQuery\PersonSearchQuery();
        $query->page($page);
        $data = $this->search->searchPerson($searchQuery, $query);
        return $data;
    }

    function getMovies($searchQuery, $page = 1){
        $query = new \Tmdb\Model\Search\SearchQuery\MovieSearchQuery();
        $query->page($page);
        $data = $this->search->searchMovie($searchQuery, $query);
        return $data;
    }
}