<?php

namespace App\Http\Controllers;

use App\Models\PrestasiDokter;
use Illuminate\Http\Request;

class PrestasiDokterController extends Controller
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
            $prestasi = PrestasiDokter::create($request->all());
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(),'data'=> []], 400);
        }
        // return $prestasi;
        return response()->json(['success' => 'Data berhasil disimpan', 'data' => $prestasi], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PrestasiDokter  $prestasiDokter
     * @return \Illuminate\Http\Response
     */
    public function show(PrestasiDokter $prestasiDokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrestasiDokter  $prestasiDokter
     * @return \Illuminate\Http\Response
     */
    public function edit(PrestasiDokter $prestasiDokter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrestasiDokter  $prestasiDokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrestasiDokter $prestasiDokter)
    {
        try {
            $prestasi = PrestasiDokter::find($request->id);
            $prestasi->update($request->all());
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(),'data'=> []], 400);
        }
        return response()->json(['success' => 'Data berhasil diubah', 'data' => $prestasi], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrestasiDokter  $prestasiDokter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $prestasi = PrestasiDokter::find($id);
            $prestasi->delete();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(),'data'=> []], 400);
        }
        return response()->json(['success' => 'Data berhasil dihapus', 'data' => $prestasi], 200);
    }
}