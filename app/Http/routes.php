<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/helloworld{id}', function ($id) {
    echo "Hello world Nattakreang 555 Laravel $id";
});

Route::auth();

Route::get('/home', 'HomeController@index');

//Route::get('/booking', 'BookingController@index');
//Route::get('/bookingupdate', 'BookingController@update');
Route::resource('/booking','BookingController');
Route::get('/booking.php/{code}/{color}/{opt}/{year}/{colorarray}','BookingController@show');
