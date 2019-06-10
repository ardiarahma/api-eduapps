<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GameCategory;

class GameCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getGameCategory() // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
     {
         $gamecategories = GameCategory::all(); // untuk mengambil semua data SubjectsCategory
         return response()->json([
             'error' => false,
             'status' => 'success',
             'result' => $gamecategories
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
        $gamecategories = new GameCategory();
        $gamecategories->name=$request->name;
        $gamecategories->description=$request->description;
        $gamecategories->save();

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $gamecategories
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
        $gamecategories = GameCategory::find($id);

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $gamecategories
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
        $gamecategories = GameCategory::where('id',$id)->first();
        $gamecategories->name  = $request->name;
        $gamecategories->description = $request->description;
        $gamecategories->save();

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $gamecategories
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
        $gamecategories = GameCategory::where('id',$id)->first();
        $gamecategories->delete();

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $gamecategories
        ]);
    }
}
