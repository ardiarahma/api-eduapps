<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['id', 'taskmaster_id', 'description', 'discussion'];
    public $timestamps = true;

    public function taskMaster()
    {
        return $this->belongsTo('App\TaskMaster', 'taskmaster_id', 'id');
        //belongsTo fk(foreign key) di app\SubjectsCategory
    }

    public function answers()
    {
        return $this->hasMany('App\Answer', 'task_id', 'id');
        //hasmany, id di app\task
    }
}
