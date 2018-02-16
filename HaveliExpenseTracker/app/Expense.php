<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
	use SoftDeletes;
	protected $fillable = ['user_id','date','amount','purpose'];
	protected $dates = ['deleted_at'];
	
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
