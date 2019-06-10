<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GameCategory extends Model
{
    protected $table = 'gamecategories';
    protected $fillable = ['id', 'name', 'description'];
    public $timestamps = true;

    public function game()
    {
        return $this->hasMany('App\GameCategory', 'gamecategories_id', 'id');
    }
}
