<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskMaster extends Model
{
    protected $table = 'task_masters';
    protected $fillable = ['id', 'title', 'class', 'semester', 'subjectscategories_id'];
    public $timestamps = true;

    public function subjectscategory()
    {
        return $this->belongsTo('App\SubjectsCategory', 'subjectscategories_id', 'id');
        //belongsTo fk(foreign key) di app\SubjectsCategory
    }

    public function tasks()
    {
        return $this->hasMany('App\Task', 'taskmaster_id', 'id');
        //hasmany, id di app\task
    }

    public function taskanswers()
    {
        return $this->hasMany('App\Task', 'taskmaster_id', 'id')->with('answers');
    }
}
