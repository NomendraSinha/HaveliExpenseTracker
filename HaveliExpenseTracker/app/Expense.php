<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	protected $fillable = ['user_id','date','amount','purpose'];
	
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
