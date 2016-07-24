<?php

namespace App\Providers;

use App\Eloquent\Activity;
use App\Globe\Sms;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $elastic = $client = ClientBuilder::create()->build();

        Activity::saved(function ($model) use ($elastic) {
            $elastic->index(['index' => 'data', 'type' => 'activity', 'id' => $model->id, 'body' => $model->toArray()]);

            $sms = new Sms();
        });
        
        /*Photo::saved(function ($model) use ($elastic) {

        });*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}