<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubjectsCategory;

class SubjectsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getSubjectsCategory() // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
     {
         $subjectscategories = SubjectsCategory::all(); // untuk mengambil semua data SubjectsCategory
         return response()->json([
             'error' => false,
             'status' => 'success',
             'result' => $subjectscategories
         ]);
     }

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
         $subjectscategories = new SubjectsCategory();
         $subjectscategories->name=$request->name;
         $subjectscategories->description=$request->description;
         $subjectscategories->save();

         return response()->json([  //biar keluarannya berupa json
             'error' => false,
             'status' => 'success',
             'result' => $subjectscategories
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
        $subjectscategories = SubjectsCategory::find($id);

        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $subjectscategories
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
        //
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
        $subjectscategories = SubjectsCategory::where('id',$id)->first();
        $subjectscategories->name  = $request->name;
        $subjectscategories->description = $request->description;
        $subjectscategories->save();

        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $subjectscategories
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
        $subjectscategories = SubjectsCategory::where('id',$id)->first();
        $subjectscategories->delete();

        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $subjectscategories
        ]);
    }
}
