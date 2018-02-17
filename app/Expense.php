<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Expense extends Model
{
	use SoftDeletes;
	protected $fillable = ['user_id','date','amount','purpose'];
	protected $dates = ['deleted_at'];
	
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Mutator
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    //Accessor
    public function getDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }
}
