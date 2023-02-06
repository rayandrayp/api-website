<?php

namespace App\Http\Controllers\API;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Validator;



class PengaduanController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255'],
            'tanggal_kejadian' => ['', 'date'],
            'lokasi_kejadian' => ['', 'string', 'max:255'],
            'pengaduan' => ['required', 'string'],
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
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return ApiFormatter::createAPI(400, 'Failed', 'Silahkan isi semua data yang diperlukan.');
        }

        $today = date('Y-m-d');
        $whatsapp = $request->whatsapp;
        $previous_pengaduan = Pengaduan::where('whatsapp', $whatsapp)->where('tanggal_kejadian', $today)->first();
        if ($previous_pengaduan) {
            return ApiFormatter::createAPI(400, 'Failed', 'Anda sudah mengirimkan pengaduan hari ini.');
        }

        try {
            $pengaduan = Pengaduan::create($request->all());
        } catch (\Throwable $th) {
            return ApiFormatter::createAPI(400, 'Failed', $th->getMessage());
        }

        return ApiFormatter::createAPI(200, 'Success', 'Sukses Menambahkan Ulasan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }
}