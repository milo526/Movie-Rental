<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use HasRoleAndPermission , SoftDeletes;

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
        return $this->rentals()->whereNull('invoice_id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice')->OrderBy('created_at', 'DESC')->limit(10);
    }

    public function payedInvoices()
    {
        return $this->invoices()->where('payed', 1);
    }

    public function unpayedInvoices()
    {
        return $this->invoices()->where('payed', 0);
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

    public function createInvoice($rentals)
    {
        $invoice = new Invoice;
        $invoice->user_id = $this->id;
        $invoice->save();

        foreach ($rentals as $rental) {
            if($rentalObject = Rental::findOrFail($rental)){
                $rentalObject->invoice()->associate($invoice);
                $rentalObject->save();
            }
        }

        return $invoice;
    }
}
