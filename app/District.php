<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    public $timestamps = true;

    public function regency()
    {
        return $this->belongsTo('App\Regency', 'regencies_id', 'id');
    }
}
