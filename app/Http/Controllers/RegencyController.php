<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regency;

class RegencyController extends Controller
{
    public function getRegency(Request $request) // fungsinya sama spt index untuk menampilkan semua data tp dalam bentuk json
    {
        if ($request->id) {
            $regencies = Regency::where('id', $request->id)->get();
        } elseif ($request->province_id) {
            $regencies = Regency::where('province_id', $request->province_id)->get();
        } else {
            $regencies = Regency::all(); // untuk mengambil semua data games
        }

        return response()->json([
            'error' => false,
            'status' => 'success',
            'result' => $regencies
        ]);
    }
}
