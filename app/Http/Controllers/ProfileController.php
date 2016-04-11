<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Invoice;
use App\Rental;

use App\Http\Requests;
use App\User;


class ProfileController extends Controller
{
	private $movies;

    function index()
    {
        return view('user/profile')->with('user', Auth::user());
    }

    function from($id){
        return view('user/profile')->with('user', User::findOrFail($id));
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
