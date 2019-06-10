<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
{
  protected $table = 'student_tasks';
  protected $fillable = ['id', 'student_id', 'taskmaster_id', 'score', 'true_answer', 'wrong_answer', 'duration'];
  public $timestamps = true;

  public function studentanswers()
  {
      return $this->belongsTo('App\StudentAnswer', 'studentanswer_id', 'id');
  }

  public function taskMaster()
  {
      return $this->belongsTo('App\TaskMaster', 'taskmaster_id', 'id');
  }

  public function student()
  {
      return $this->belongsTo('App\Student', 'student_id', 'id');
  }
}
