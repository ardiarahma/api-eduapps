<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskMaster;
use App\SubjectsCategory;
use App\LogActivity;
use App\Answer;
use App\Task;
use Auth;
use App\User;

class TaskMasterController extends Controller
{

    public function getTaskMaster() // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
    {
        LogActivity::create([
            'user_id' => Auth::user()->id,
            'fitur'   => 'Bank Soal'
        ]);

        $task_masters = TaskMaster::all(); // untuk mengambil semua data games
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $task_masters
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task_masters = new TaskMaster();
        $task_masters->title=$request->title;
        $task_masters->class=$request->class;
        $task_masters->semester=$request->semester;
        $task_masters->subjectscategories_id=$request->subjectscategories_id;
        $task_masters->total_task=$request->total_task;
        $task_masters->save();

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $task_masters
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task_masters = TaskMaster::find($id);
           // dd($ebooks);
        $subjectscategories = SubjectsCategory::all();

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $task_masters
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task_masters = TaskMaster::find($id);
        $subjectscategories = SubjectsCategory::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task_masters = TaskMaster::where('id',$id)->first();
        $task_masters->title=$request->title;
        $task_masters->class=$request->class;
        $task_masters->semester=$request->semester;
        $task_masters->subjectscategories_id=$request->subjectscategories_id;

        $task_masters->save();

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $task_masters
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task_masters = TaskMaster::where('id',$id)->first();
        $task_masters->delete();

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $task_masters
        ]);
    }

    public function getTaskMasterClass(Request $request)
    {
        $task_masters = TaskMaster::where('subjectscategories_id', $request->subjectscategories)
                        ->where('class', $request->class)
                        ->get();
                        // dd($ebooks);
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $task_masters
        ]);
    }

    public function api_LogTask(Request $request) // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
    {
        LogActivity::create([
            'user_id' => Auth::user()->id,
            'fitur'   => 'Mini Games'
        ]);

        $log_task = new LogActivity; // untuk mengambil semua data games
        $log_task->user_id = $request->id;
        $log_task->fitur = $request->fitur;
        $log_task->save();
        $user = User::find($log_task->user_id);
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => ['menu'=>$log_task, 'user'=>$user],
        ]);
    }

    public function api_soal(Request $request)
    {
        // dd($request);
        // $task_master = TaskMaster::find($id);
        // $tasks = TaskMaster::where('id', $id)->first()->tasks()->get();
        $task_master_id = $request->id;
        $task_master = TaskMaster::find($task_master_id);
        $tasks = TaskMaster::where('id', $task_master_id)
                               ->where('class', $request->class)
                               // ->where('semester', $request->semester)
                               ->first();
        if($tasks){
            $tasks = TaskMaster::where('id', $task_master_id)
                                   ->where('class', $request->class)
                                   // ->where('semester', $request->semester)
                                   ->first()->taskanswers()->get(); //answers karena di function model diberi nama answers
        }
        else {
          return response()->json([
              'error'  => true,
              'status' => 'error',
              'message'   => 'not found task'
          ]);
        }
        $soal  = [];
        foreach ($tasks as $key => $item) {
            $soal[$key] = $item
                          ->first();
        }
        $pilgan  = [];
        foreach ($tasks as $key => $item) {
            $pilgan[$key] = $item
                          ->answers()
                          ->orderBy('choice', 'asc')
                          ->get();
        }

        $collection = [];
        foreach ($tasks as $i => $taskss) {
          $collection[$i] = [
            'id' => $taskss['id'],
            'description' => $taskss['description'],
            'A' => $pilgan[$i]->get(0)->choice_answer,
            'B' => $pilgan[$i]->get(1)->choice_answer,
            'C' => $pilgan[$i]->get(2)->choice_answer,
            'D' => $pilgan[$i]->get(3)->choice_answer,
            'Answer' => $pilgan[$i]->where('is_answer', 1)->first()->choice_answer,
            'discussion' => $taskss['discussion'],
          ];
        }

        return response()->json([
            'error'  => false,
            'status' => 'success',
            'result'   => $collection
        ]);
    }
}
