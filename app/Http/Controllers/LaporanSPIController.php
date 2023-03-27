<?php

namespace App\Http\Controllers;

use App\Models\LaporanSPI;
use Illuminate\Http\Request;

class LaporanSPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['list_laporan_spi'] = LaporanSPI::all();
        return view('laporanSPI.index', $this->data);
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
     * @param  \App\Models\LaporanSPI  $laporanSPI
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan_spi = LaporanSPI::find($id);
        if($laporan_spi == null){
            return response()->json([
                'status' => 'error',
                'message' => 'LaporanSPI not found'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $laporan_spi
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanSPI  $laporanSPI
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanSPI $laporanSPI)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanSPI  $laporanSPI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanSPI $laporanSPI)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanSPI  $laporanSPI
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanSPI $laporanSPI)
    {
        //
    }
}