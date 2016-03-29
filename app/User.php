<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rentals()
    {
        return $this->hasMany('App\Rental')->OrderBy('created_at', 'DESC');
    }

    public function basketRentals()
    {
        return $this->hasMany('App\Rental')->whereNull('invoice_id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    
    public function unpayedInvoices()
    {
        $invoices = $this->invoices;
        $unpayed = [];
        foreach ($invoices as $invoice) {
            if(!$invoice->payed){
                $unpayed[] = $invoice;
            }
        }
        return $unpayed;
    }    

    public function rent($id)
    {
        $rental = new Rental;

        $rental->user_id = $this->id;
        $rental->movie_id = $id;

        $rental->save();

        return $rental;
    }

    public function removeRent($id)
    {
        if($rental = Rental::find($id)){
            $rental->delete();
            return true;
        }
        return false;
    }
}
