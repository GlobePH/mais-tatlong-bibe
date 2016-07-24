<?php

namespace App\Http\Controllers\Api;

use App\Eloquent\Activity;
use App\Events\ActivityDetected;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class DataController extends Controller
{
	public function index()
	{
		//echo Auth::user()->access->token;exit;
		//return $d = Activity::find(21);
		$client = ClientBuilder::create()->build();

		//return $client->indices()->delete(['index' => 'data']);
		//return $client->delete(['index' => 'data', 'type' => 'activity', 'id' => 'my_id']);
		//return $client->index(['index' => 'data', 'type' => 'activity', 'id' => 1, 'body' => ['name' => 'ronald']]);
		//return $response = $client->get(['index' => 'data', 'type' => 'activity', 'id' => 1]);
		$params = ['index' => 'data', 'type' => 'activity', 'body' => ['query' => ['match_all' => []]]];
		//$params = ['index' => 'data', 'type' => 'activity', 'body' => ['query' => ['match' => ['id' => 18]]];
		return $response = $client->search($params);
	}

	public function store(Request $request)
	{
		$activity = Activity::create([
			'title' => $request->get('title'),
			'description' => $request->get('description'),
			'latitude' => $request->get('latitude'),
			'longitude' => $request->get('longitude'),
			'data' => collect($request->all())->except(['title', 'description', 'latitude', 'longitude']),
		]);

		Event::fire(new ActivityDetected($activity));
	}
}
