<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;

use App\Http\Requests;

use App\User;
use App\Invoice;
use App\Rental;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin/index')->with('users', User::all())->with('invoices', Invoice::all())->with('rentals', Rental::all());
    }

    public function permissions($id)
    {
        return view('admin/getPermissions')->with('user', User::find($id));
    }
}
