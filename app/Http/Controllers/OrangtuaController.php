<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Orangtua;
use App\LogActivity;
use App\StudentTask;
use Illuminate\Support\Facades\Hash;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // public function api_LogActivity(Request $request)
	   //   {
     //
	   //       $ortu = Orangtua::where('user_id',$request->id)->first();
	   //       //dd($ortu);
			//  $anak = Student::where('orangtua_id',$ortu->id)
	   //                       ->leftJoin('users','students.user_id','users.id')
	   //                       ->get();
	   //       // dd($anak);
	   //       foreach ($anak as $key => $value) {
	   //         $log = LogActivity::where('user_id',$value->user_id)->get();
	   //         // dd($log);
	   //         return response()->json([
	   //           'error' => false,
	   //           'status' => 'success',
	   //           //'orangtua' => $ortu,
	   //           'anak' => $anak,
	   //           'log' => $log
	   //         ]);
	   //       }
     //
	   //   }

		public function activityReport(Request $request)
		{
			$anak = Student::where('user_id',$request->id)
	                         ->leftJoin('users','students.user_id','users.id')
	                         ->first();
	         // dd($anak);
	           $log = LogActivity::where('user_id',$request->id)->get();
	           // dd($log);
	           return response()->json([
	             'error' => false,
	             'status' => 'success',
	             //'orangtua' => $ortu,
	             'anak' => $anak,
	             'log' => $log
	           ]);

		}

    public function studyReport(Request $request)
    {
  
		 $report = StudentTask::leftJoin('task_masters','student_tasks.taskmaster_id','task_masters.id')
		 										->leftJoin('students','student_tasks.student_id','students.id')
												->where('students.user_id',$request->id)
		 										->select('student_tasks.id','student_tasks.score','task_masters.title')->get();
		 // dd($cek);

		 return response()->json([
			 'error' => false,
			 'status' => 'success',
			 'result' => $report
		 ]);

      // $log =
    }

       public function getOrangtua(Request $request)
     {

         $user = User::where('id',$request->id) //user dimana id nya = request-nya (request id-nya)
         // ->with('orangtua') // fungsi orangtua yang ada di model User
         ->first(); // untuk mengambil satu data ortu

         $siswa = Student::leftJoin('orangtuas','students.orangtua_id','orangtuas.id') // yang dipanggil orangtua id karena di dua tabel yang menghubungkan adalah orang tua id-nya.
                            ->leftJoin('users','students.user_id','users.id')
                            ->where('orangtuas.user_id', $request->id)
                            ->get();
         // $siswa = Orangtua::where('user_id', $request->id)->get();
         // dd($siswa);
         return response()->json([
             // 'user_id' => Auth::user()->id,
             'error' => false,
             'status' => 'success',
             'result' => $user,
             'anak' => $siswa

         ]);
     }

     public function detailsAnak(Request $request)
		 {
		 	$anak = Student::leftJoin('orangtuas','students.orangtua_id','orangtuas.id') // yang dipanggil orangtua id karena di dua tabel yang menghubungkan adalah orang tua id-nya.
												 ->leftJoin('users','students.user_id','users.id')
												 ->where('orangtuas.user_id', $request->id)
												 ->get();

			return response()->json([
				'status' => 'success',
				'result' => $anak
			]);
		 }

		public function api_detailProfil(Request $request)
    {
        $user = User::where('id',$request->id)
        ->with('orangtua')
        ->first();
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $user
        ]);
    }

    public function getNews()
    {
        $curl = curl_init();

        $query = http_build_query([
            'q'         => "siswa berprestasi",
            'apiKey'    => "6a385e9bf2374b8692bb204204c394ee",
            'sortBy'    => "publishedAt"
        ]);
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://newsapi.org/v2/everything?".$query,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, true); //because of true, it's in an array
        // dd($response);
        // return view('orangtua.dashboard', compact('response'));
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $response
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
		 public function api_updateProfil(Request $request, $id){
         $this->validate($request, [
                  'name'          => 'required',
                  'username'      => 'required',
                  'email'         => 'required|email'
            ],

            [
                 'name.required'          => 'Nama harus diisi!',
                 'username.required'      => 'Username harus diisi!',
                 'email.required'         => 'Email harus diisi!',
             ]
        );
 				$data = Orangtua::where('user_id', $id)->first();
        $ortu = User::where('id',$data->user_id)->first();

  			$ortu->name=$request->name;
        $ortu->username=$request->username;
        $ortu->email=$request->email;
        $ortu->save();
        return response()->json([
            'error' => false,
            'status' => 'success',
            'user' => $ortu
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
        //
    }

		public function api_updatePasswOrtu(Request $request, $id)
    {
        $data = Orangtua::where('user_id',$id)->first();
        $ortu = User::where('id',$data->user_id)->first();
        // dd($ortu);
        if (Hash::check($request->oldPassword, $ortu->password))
        {
            $this->validate($request, [
                     'oldPassword'           => 'required',
                     'password'              => 'required|min:6|confirmed',
                     'password_confirmation' => 'required',
               ],
               [
                   'oldPassword.required'            => 'Password lama harus diisi!',
                   'password.required'               => 'Password baru harus diisi!',
                   'password_confirmation.required'  => 'Konfirmasi password baru harus diisi!',
                ]
            );
            $ortu->password = Hash::make($request->password);
            $ortu->save();
        }
        else {
            $this->validate($request, [
                     'oldPassword'           => 'required',
                     'password'              => 'required|min:6|confirmed',
                     'password_confirmation' => 'required',
               ],
               [
                   'oldPassword.required'           => 'Password lama harus diisi!',
                   'password.required'           => 'Password baru harus diisi!',
                   'password_confirmation.required' => 'Konfirmasi password baru harus diisi!',
                ]
            );
        }
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $ortu
        ]);
    }

    public function api_updatePasswSiswa(Request $request, $id)
    {
        $data = Student::where('user_id',$id)->first();
        $siswa = User::where('id',$data->user_id)->first();
        // dd($data);
        if (Hash::check($request->oldPassword, $siswa->password))
        {
            $this->validate($request, [
                     'oldPassword'           => 'required',
                     'password'              => 'required|min:6|confirmed',
                     'password_confirmation' => 'required',
               ],
               [
                   'oldPassword.required'            => 'Password lama harus diisi!',
                   'password.required'               => 'Password baru harus diisi!',
                   'password_confirmation.required'  => 'Konfirmasi password baru harus diisi!',
                ]
            );
            $siswa->password = Hash::make($request->password);
            $siswa->save();
        }else {
            $this->validate($request, [
                     'oldPassword'           => 'required',
                     'password'              => 'required|min:6|confirmed',
                     'password_confirmation' => 'required',
               ],
               [
                   'oldPassword.required'            => 'Password lama harus diisi!',
                   'password.required'               => 'Password baru harus diisi!',
                   'password_confirmation.required'  => 'Konfirmasi password baru harus diisi!',
                ]
            );
        }
        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $siswa
        ]);
    }

}
