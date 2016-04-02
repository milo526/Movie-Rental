<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Invoice;
use App\Rental;

use App\Http\Requests;


class ProfileController extends Controller
{
	private $movies;

    function index()
    {
        return view('user/profile');
    }

    function rent()
    {
    	if(!isset($_POST['movie_id'])){
    		return false;
    	}

    	$id = $_POST['movie_id'];
    	$rental = Auth::user()->rent($id);
    	echo($rental->toJson());
    }

    function removeRent()
    {
        if(!isset($_POST['movie_id'])){
            return false;
        }

        $id = $_POST['movie_id'];
        echo(Auth::user()->removeRent($id));
    }
}
