<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Invoice;
use App\Rental;

use App\Http\Requests;


class InvoiceController extends Controller
{

    function get($id){
        if($invoice = Invoice::find($id)){
            if(Auth::user()->can('get', $invoice)){
                return view('invoice')->with('invoice', $invoice);
            }
        } 
        return Redirect::route('profile::index')->withErrors(['Could not find invoice!']);
    }

    function make(){
        if(!isset($_POST['rentals'])){
            abort(400);
        }

        if(!$_POST['rentals']){
            redirect()->route('profile::index');
        }

        $rentals = $_POST['rentals'];
        $invoice = Auth::User()->createInvoice($rentals);
        echo($invoice->toJson());
    }
}
