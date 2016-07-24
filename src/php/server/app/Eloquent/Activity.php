<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['title', 'description', 'latitude', 'longitude', 'data'];

    protected $casts = ['data' => 'json'];
}