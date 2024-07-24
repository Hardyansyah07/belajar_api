<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index(){
        $film = Film::latest()->get();
        $response = [
            'success' => 'true',
            'message' => 'Daftar film',
            'data' => $film,
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $film = new Film();
        $film->judul = $request->judul;
        $film->slug = $request->slug;
        $film->foto = $request->foto;
        $film->deskripsi = $request->deskripsi;
        $film->url_video = $request->url_video;
        $film->id_kategori = $request->id_kategori;
        $film->id_genre = $request->id_genre;
        $film->id_aktor = $request->id_aktor;
        $film->save();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan',
        ], 201);
    }

    public function show($id)
    {
        $film = Film::find($id);
        if($film) {
            return response()->json([
                'success' => true,
                'message' => 'detail film disimpan',
                'data' => $film,
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
        $film = Film::find($id);
        if($film) {
            $film->judul = $request->judul;
            $film->slug = $request->slug;
            $film->foto = $request->foto;
            $film->deskripsi = $request->deskripsi;
            $film->url_video = $request->url_video;
            $film->id_kategori = $request->id_kategori;
            $film->id_genre = $request->id_genre;
            $film->id_aktor = $request->id_aktor;
        $film->save();
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
    $film = film::find($id);
    if($film) {
        $film->delete();
        return response()->json([
            'success' => true,
            'message' => 'data' . $film->judul . 'berhasil dihapus',
        ]);
    } else {
        return response()->json([
            'success' => true,
            'message' => 'data tidak ditemukan',
        ], 404);
    }
}
}
