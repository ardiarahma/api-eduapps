<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubjectsCategory extends Model
{
    protected $table = 'subjectscategories';
    protected $fillable = ['id', 'name', 'description'];
    public $timestamps = true;
}
