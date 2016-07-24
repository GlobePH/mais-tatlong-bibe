<?php

namespace App\Eloquent;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access_token';

    protected $fillable = ['token', 'mobile_no'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
