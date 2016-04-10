<?php
use Tmdb\Laravel\Facades\Tmdb;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'IndexController@index')->name('index');
    Route::group(['middleware' => ['auth'], 'prefix' => 'faq', 'as' => 'faq::'], function () {
        Route::get('/', 'FAQController@index')->name('index');
        Route::get('/create/{id?}', 'FAQController@create')->name('create')->where('id', '[0-9]+');
            Route::post('/make', 'FAQController@make')->name('make');
            Route::get('/edit/{id}', 'FAQController@edit')->name('edit');
            Route::post('/edit/{id}', 'FAQController@postEdit')->name('postEdit');
    });
	
	Route::get('/movie/{id}', 'MovieController@index');
	Route::get('/actor/{id}', 'ActorController@index');
	Route::get('/crew/{id}', 'ActorController@index');
    Route::auth();

    Route::group(['prefix' => 'search', 'as' => 'search::'], function () {
        Route::post('/', 'SearchController@post')->name('post');
        Route::get('/movie/{query}/{page?}', 'SearchController@searchMovie')->name('movie')->where('page', '[0-9]+');
        Route::get('/person/{query}/{page?}', 'SearchController@searchPerson')->name('person')->where('page', '[0-9]+');
        Route::get('/{query}/{page?}', 'SearchController@searchMulti')->name('multi')->where('page', '[0-9]+');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'profile', 'as' => 'profile::'], function () {
    	Route::get('/', 'ProfileController@index')->name('index');
    	Route::post('/rent', 'ProfileController@rent');
    	Route::post('/rent/delete', 'ProfileController@removeRent');
        Route::get('/invoice/{id}', 'InvoiceController@get')->name('invoice');
        Route::post('/invoice', 'InvoiceController@make');
        Route::post('/invoice/pay/{id}', 'InvoiceController@pay')->name('payInvoice');
    });

    Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin::'], function () {
        Route::get('/', 'ProfileController@index')->name('index');
    });

});