<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQCategory extends Model
{
    public function questions()
    {
        return $this->hasMany('App\FAQItem', 'category_id')->OrderBy('created_at', 'ASC');
    }
}
