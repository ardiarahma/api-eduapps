<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EBook;
use App\LogActivity;
use Auth;
use App\Student;
use App\User;

class EbookController extends Controller
{
    public function getEbook() // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
    {
        LogActivity::create([
            'user_id' => Auth::user()->id,
            'fitur'   => 'E-Book'
        ]);

        $ebooks = EBook::all(); // untuk mengambil semua data games
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $ebooks
        ]);
    }

    public function getEbookClass(Request $request)
    {
        $ebooks = EBook::where('subjectscategories_id', $request->subjectscategories)
                        ->where('class', $request->class)
                        ->get();
                        
		foreach ($ebooks as $key => $value){
			$value->image = asset('images/'.$value->image.'');
		}
        //dd($ebooks);
		return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $ebooks
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
       $ebooks = new EBook();
       $ebooks->title=$request->title;
       $ebooks->subjectscategories_id=$request->subjectscategories_id;
       $ebooks->class=$request->class;
       $ebooks->semester=$request->semester;
       $ebooks->author=$request->author;
       $ebooks->publisher=$request->publisher;
       $ebooks->year=$request->year;
       $ebooks->url=$request->url;

           // $image   = $request->file('image');
           // $ext     = $image->getClientOriginalExtension();
           // $newName = rand(100000,1001238912).".".$ext;
           // $image->move('images',$newName);
           // $ebooks->image = $newName;
       $ebooks->save();

       return response()->json([
           'error' => false,
           'status' => 'success',
           'result' => $ebooks
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
        $ebooks = EBook::find($id);
        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $ebooks
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
        // dd($request);
        $ebooks = EBook::where('id',$id)->first();
        $ebooks->title=$request->title;
        $ebooks->subjectscategories_id=$request->subjectscategories_id;
        $ebooks->class=$request->class;
        $ebooks->semester=$request->semester;
        $ebooks->author=$request->author;
        $ebooks->publisher=$request->publisher;
        $ebooks->year=$request->year;
        $ebooks->url=$request->url;
        $ebooks->save();

        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $ebooks
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
        $ebooks = EBook::where('id',$id)->first();
        $ebooks->delete();

        return response()->json([  //biar keluarannya berupa json
            'error' => false,
            'status' => 'success',
            'result' => $ebooks
        ]);
    }

    public function api_LogEbook(Request $request) // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
    {
        $log = LogActivity::create([
            'user_id' => $request->id,
            'fitur' => $request->fitur

            // 'user_id' => Auth::user()->id,
            // 'fitur'   => 'E-Book'
        ]);


        $log_ebook = new LogActivity; // untuk mengambil semua data games
        $log_ebook->user_id = $request->id;
        $log_ebook->fitur = $request->fitur;
        $log_ebook->save();
        $user = User::find($log_ebook->user_id);
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => ['menu'=>$log_ebook, 'user'=>$user],
        ]);
    }
}
