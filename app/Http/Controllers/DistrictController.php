<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;

class DistrictController extends Controller
{
    public function getDistrict(Request $request) // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
    {
        if ($request->id) {
            $districts = District::where('id', $request->id)->get();
        } elseif ($request->regency_id) {
            $districts = District::where('regency_id', $request->regency_id)->get();
        } else {
            $districts = District::all(); // untuk mengambil semua data games
        }


        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $districts
        ]);
    }

}
