<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTask() // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
    {
        $tasks = Task::all(); // untuk mengambil semua data games
        return response()->json([
            'status' => 'success',
            'result' => $tasks
        ]);
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        // dd($request);

        $tasks = [];
        for ($i=0; $i < @count($request->task["description"]); $i++) {
            $tasks[$i] = [
                'taskmaster_id' => $request->taskmaster_id,
                'description'   => $request->task["description"][$i],
                'discussion'    => $request->task["discussion"][$i],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ];
        }
        // dd($tasks);

        $answers = [];
        $choices = ['a', 'b', 'c', 'd'];
        for ($i=0; $i < @count($request->answer); $i++) {
            for ($j=0; $j < @count($request->answer[$i]); $j++) {
                $answers[$i][$j] = [
                    'choice'        => $choices[$j],
                    'choice_answer' => $request->answer[$i][$j],
                    'user_answer'   => null,
                    'is_answer'     => $request->true_answer[$i] == $j+1 ? 1 : 0,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ];
            }
        }
        // dd($answers);

        foreach ($tasks as $key => $task) {
            $task_result = Task::create($task);
            if (!$task_result) {
                DB::rollback();
            }
            $answer_result = $task_result->answers()->createMany($answers[$key]);
            if (!$answer_result) {
                DB::rollback();
            }
        }

        DB::commit();

        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $tasks
        ]);

    }

    public function show($id)
    {

    }

    public function edit($id, Request $request)
    {
        $tasks = TaskMaster::where('id', $id)->first()->tasks()->get();
        $answers = [];
        foreach ($tasks as $key => $curr_task) {
            $answers[$key] = $curr_task->answers()->orderBy('choice', 'asc')->get();
        }

        // dd($answers);
        $total = $request->total_task;
        $choices = ['a', 'b', 'c', 'd'];
        $taskmaster_id = $id;
        // return view('task.edit', compact('tasks', 'answers', 'total', 'choices', 'taskmaster_id'));
        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $tasks
        ]);
    }

    public function update(Request $request, $id)
        {

            DB::beginTransaction();
            // dd($request);
            $existing_task = Task::where('taskmaster_id', $id)->get();
            foreach ($existing_task as $key => $curr_task) {
                $existing_answer = Answer::where('task_id', $curr_task->id)->delete();
                if (!$existing_answer) {
                    DB::rollback();
                }
                $curr_task->delete();
                if (!$curr_task) {
                    DB::rollback();
                }
            }

            $tasks = [];
            for ($i=0; $i < @count($request->task["description"]); $i++) {
                $tasks[$i] = [
                    'taskmaster_id' => $request->taskmaster_id,
                    'description'   => $request->task["description"][$i],
                    'discussion'    => $request->task["discussion"][$i],
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ];
            }
            // dd($tasks);

            $answers = [];
            $choices = ['a', 'b', 'c', 'd'];
            for ($i=0; $i < @count($request->answer); $i++) {
                for ($j=0; $j < @count($request->answer[$i]); $j++) {
                    $answers[$i][$j] = [
                        'choice'        => $choices[$j],
                        'choice_answer' => $request->answer[$i][$j],
                        'user_answer'   => null,
                        'is_answer'     => $request->true_answer[$i] == $j+1 ? 1 : 0,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
                    ];
                }
            }
            // dd($answers);

            foreach ($tasks as $key => $task) {
                $task_result = Task::create($task);
                if (!$task_result) {
                    DB::rollback();
                }
                $answer_result = $task_result->answers()->createMany($answers[$key]);
                if (!$answer_result) {
                    DB::rollback();
                }
            }

            DB::commit();
            return response()->json([  //biar keluarannya berupa json
                'error' => false,
                'status' => 'success',
                'result' => $tasks
            ]);

        }

    public function destroy($id)
    {
        //
    }


}
