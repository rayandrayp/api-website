<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisLaporanPengaduan;
use App\Helpers\ApiFormatter;
use Exception;
use Illuminate\Support\Facades\Validator;


class JenisLaporanPengaduanController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            "jenis_laporan" => ["required", "string", "max:255"],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisLaporanPengaduan = JenisLaporanPengaduan::all();
        return ApiFormatter::createAPI(200, 'Success', $jenisLaporanPengaduan);
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
        try {
            $jenisLaporanPengaduan = JenisLaporanPengaduan::create($request->all());
            return ApiFormatter::createAPI(200, 'Success', $jenisLaporanPengaduan);
        } catch (\Throwable $th) {
            return ApiFormatter::createAPI(400, 'Failed', $th);
        }
        ApiFormatter::createAPI(200, 'Success','Sukses menambahkan data.');
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
    public function update(Request $request, $id)
    {
        //
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
}