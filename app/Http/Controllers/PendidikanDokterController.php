<?php

namespace App\Http\Controllers;

use App\Models\PendidikanDokter;
use Illuminate\Http\Request;

class PendidikanDokterController extends Controller
{
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
        try {
            $pendidikan = PendidikanDokter::create([
                'kd_dokter' => $request->kd_dokter,
                'pendidikan' => $request->pendidikan,
                'perguruan_tinggi' => $request->perguruan_tinggi,
                'tahun' => $request->tahun,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menambahkan data pendidikan dokter',
                'error' => $th->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'Berhasil menambahkan data pendidikan dokter',
            'data' => $pendidikan
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PendidikanDokter  $pendidikanDokter
     * @return \Illuminate\Http\Response
     */
    public function show(PendidikanDokter $pendidikanDokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PendidikanDokter  $pendidikanDokter
     * @return \Illuminate\Http\Response
     */
    public function edit(PendidikanDokter $pendidikanDokter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PendidikanDokter  $pendidikanDokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PendidikanDokter $pendidikanDokter)
    {
        $pendidikan = PendidikanDokter::find($request->id);
        
        try {
            $pendidikan->update([
                'kd_dokter' => $request->kd_dokter,
                'pendidikan' => $request->pendidikan,
                'perguruan_tinggi' => $request->perguruan_tinggi,
                'tahun' => $request->tahun,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal mengubah data pendidikan dokter',
                'error' => $th->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'Berhasil mengubah data pendidikan dokter',
            'data' => $pendidikan
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PendidikanDokter  $pendidikanDokter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pendidikan = PendidikanDokter::find($id);
        try {
            $pendidikan->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menghapus data pendidikan dokter',
                'error' => $th->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'Berhasil menghapus data pendidikan dokter',
            'data' => $pendidikan
        ], 200);
    }
}