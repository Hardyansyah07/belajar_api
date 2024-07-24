<?php

namespace App\Http\Controllers;

use App\Models\Aktor;
use Illuminate\Http\Request;

class AktorController extends Controller
{
    public function index(){
        $aktor = Aktor::latest()->get();
        $response = [
            'success' => 'true',
            'message' => 'Daftar aktor',
            'data' => $aktor,
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $aktor = new Aktor();
        $aktor->nama_aktor = $request->nama_aktor;
        $aktor->bio = $request->bio;
        $aktor->save();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
        ], 201);
    }

    public function show($id)
    {
        $aktor = Aktor::find($id);
        if($aktor) {
            return response()->json([
                'success' => true,
                'message' => 'detail aktor disimpan',
                'data' => $aktor,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $aktor = Aktor::find($id);
        if($aktor) {
        $aktor->nama_aktor = $request->nama_aktor;
        $aktor->bio = $request->bio;
        $aktor->save();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'data tidak ditemukan',
        ], 404);

    }
}

public function destroy($id)
{
    $aktor = Aktor::find($id);
    if($aktor) {
        $aktor->delete();
        return response()->json([
            'success' => true,
            'message' => 'data' .  $aktor->nama_aktor  . 'berhasil dihapus',
        ]);
    } else {
        return response()->json([
            'success' => true,
            'message' => 'data tidak ditemukan',
        ], 404);
    }
}
}
