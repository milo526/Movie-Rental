<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\FAQCategory;

class FAQController extends Controller
{
    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
    	$categories = FAQCategory::All();
        return view('faq')->with('categories', $categories);
    }
}
