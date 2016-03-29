<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function rentals()
    {
        return $this->hasMany('App\Rental')->OrderBy('created_at', 'DESC');
    }

    public function date()
    {
    	return date_create($this->created_at);
    }
}
