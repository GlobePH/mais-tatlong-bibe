<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $fillable = ['caption', 'address', 'latitude', 'longitude', 'original_name', 'path'];
}