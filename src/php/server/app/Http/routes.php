<?php

use Illuminate\Support\Facades\Auth;

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

//use App\Eloquent\Activity;
//use Elasticsearch\ClientBuilder;
Route::get('/', function() {

	
	
	//return 'test';
	/*
	$user = Auth::user();
	return $user->access;
	echo 'test';
	exit;
	*/
	return view('index');
});

Route::group(['prefix' => 'api'], function() {
	header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');

	Route::get('weather', 'Api\WeatherController@index');
	Route::get('earthquake', 'Api\EarthquakeController@index');
	
	Route::get('data', 'Api\DataController@index');
	Route::post('data', 'Api\DataController@store');
	
	//Route::post('photos', 'Api\PhotosController@store');
});

Route::get('/auth/globe', 'Auth\AuthController@globe');
Route::auth();
Route::get('/home', 'HomeController@index');
