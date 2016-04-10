<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQItem extends Model
{
	public function category(){
    	return $this->belongsTo('App\FAQCategory');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
