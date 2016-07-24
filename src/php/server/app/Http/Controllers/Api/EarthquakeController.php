<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EarthquakeController extends Controller
{
	public function index()
	{
		//http://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson&starttime=2014-01-01&endtime=2014-01-02
		$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', 'http://earthquake.usgs.gov/fdsnws/event/1/query', [
		    //'auth' => ['user', 'pass'],
		    'query' => [
		    	'format' => 'geojson',
		    	'starttime' => '2014-01-01', 'endtime' => '2014-01-02',
		    	//'minlatitude' => '', 'minlongitude' => '', 'maxlatitude' => '', 'maxlongitude' => '',
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