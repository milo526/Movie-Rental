<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Tmdb\Helper\ImageHelper;
use Tmdb\Repository\PeopleRepository;

class ActorController extends Controller{

	private $people;

	public function __construct(PeopleRepository $people, ImageHelper $helper){
        $this->people = $people;
    }

    function index($id)
    {
        // returns information of a actor
        $person = $this->people->load($id);
        return view('data/actor')->with('person', $person);
    }
}