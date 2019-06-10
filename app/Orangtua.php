<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    protected $table = 'orangtuas';
    protected $fillable = ['id', 'user_id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function student()
    {
        return $this->hasMany('App\Student', 'orangtua_id', 'id');
    }
}
