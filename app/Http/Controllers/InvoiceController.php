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
            if (Auth::user()->allowed('all.get.invoice', $invoice)) {
                return view('invoice')->with('invoice', $invoice);
            }
        } 
        return Redirect::route('profile::index')->withErrors(['Could not find invoice!']);
    }

    function make(Request $request){
        $rentals = $request->input('rentals');
        if(!isset($rentals)){
            abort(400);
        }

        if(!$rentals){
            redirect()->route('profile::index');
        }

        $invoice = Auth::User()->createInvoice($rentals);
        echo('{"invoice":'.$invoice->toJson().','.'"rentals":'.json_encode($rentals).'}');
    }

    function pay($id){
        if($invoice = Invoice::find($id)){
            if (Auth::User()->allowed('all.pay.invoice', $invoice)) {
                $invoice->payed = true;
                $invoice->save();
                return Redirect::route('profile::index')->with('invoice', 'Succesfully payed invoice!');
            }
        } 
        return Redirect::route('profile::index')->withErrors(['Could not find invoice!']);
    }
}
