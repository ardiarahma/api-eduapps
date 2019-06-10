<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    public $timestamps = true;

    public function regency()
    {
        return $this->hasMany('App\Regency', 'province_id', 'id');
    }
}
