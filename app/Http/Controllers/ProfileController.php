<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;


class ProfileController extends Controller
{
	private $movies;

    function index()
    {
        return view('user/profile');
    }

    function rent($id)
    {
    	$rental = Auth::user()->rent($id);
    	return view('user/profile')->with('rental', $rental);
    }
}
