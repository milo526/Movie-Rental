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

    public function rent($id)
    {
        $rental = new Rental;

        $rental->user_id = $this->id;
        $rental->movie_id = $id;

        $rental->save();

        return $rental;
    }
}
