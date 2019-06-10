<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
  protected $table = 'student_answers';
  protected $fillable = ['id', 'studenttask_id', 'student_id', 'taskmaster_id', 'task_id', 'answer', 'is_true'];
  public $timestamps = true;

  public function answers()
  {
      return $this->hasManyThrough('App\TaskMaster', 'App\Task', 'App\Answer');
  }

  public function studenttasks()
  {
      return $this->hasMany('App\StudentTask', 'studentanswer_id', 'id');
  }
}
