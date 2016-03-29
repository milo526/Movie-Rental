<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Tmdb;
use Tmdb\Model\Movie;

class Rental extends Model
{
    use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'movie_id', 'invoice_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $appends = ['MovieName'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function invoice()
    {
    	return $this->belongsTo('App\Invoice');
    }

    public function isPayed()
    {
        if(isset($this->invoice_id)){
            return $this->invoice->payed;
        }
        return false;
    }

    public function date()
    {
    	return date_create($this->created_at);
    }

    /**
     * @return $movie/null
     */
    public function getMovie()
    {
    	$client = new \Tmdb\Client(TMDB::getToken());
    	$repository = new \Tmdb\Repository\MovieRepository($client);
    	return $repository->load($this->movie_id);
    }

    public function getMovieNameAttribute() {
      return $this->getMovie()->getTitle();
   }
}
