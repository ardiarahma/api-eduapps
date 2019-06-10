<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['id', 'task_id', 'choice', 'choice_answer', 'user_answer', 'is_answer'];
    public $timestamps = true;

    public function taskMaster()
    {
        return $this->belongsTo('App\TaskMaster', 'taskmaster_id', 'id');
        //belongsTo fk(foreign key) di app\SubjectsCategory
    }
}
