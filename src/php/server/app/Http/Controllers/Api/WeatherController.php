<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
    	//http://api.openweathermap.org/data/2.5/box/city?bbox=12,32,15,37,10&cluster=yes
		$client = new \GuzzleHttp\Client();
		//$response = $client->request('GET', 'http://api.openweathermap.org/data/2.5/weather', [
		$response = $client->request('GET', 'http://api.openweathermap.org/data/2.5/box/city', [
		    //'auth' => ['user', 'pass'],
		    'query' => [
		    	'appid' => 'c6e48ad059d406b2a65b54abaf4cd5d8',
		    	//'lat' => 13, 'lon' => 122,
		    	//'bbox' => '12,32,15,37,10',
		    	'bbox' => implode(',', $request->get('bounds', [12, 32, 15, 37, 10])),
		    	'cluster' => 'yes',
		    ]
		]);
		
		die($response->getBody());
		//try {
		return response($response->getBody(), $response->getStatusCode())
			->header('Content-Type', $response->getHeader('Content-Type'));
		//} catch (Exception $e) {

		//}
    }
}