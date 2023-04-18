<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Spesialis;
use App\Models\Dokter;

class SpesialisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spesialis = Spesialis::with('dokter')->get();

        return ApiFormatter::createAPI(200, 'Success', $spesialis);
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
        if ($id == "konsulan"){
            $arr_dokter = ['1910056850268','D0000141','201706004','D0000142','D0000144'];
            $spesialis['kd_sps'] = "konsulan";
            $spesialis['nm_sps'] = "Dokter Konsulan";
            $spesialis['dokter'] = Dokter::whereIn('kd_dokter', $arr_dokter)
                                ->select('kd_dokter', 'nm_dokter', 'kd_sps', 'imagepath')
                                ->get();
            return ApiFormatter::createAPI(200, 'Success', $spesialis);
        } else {
            $spesialis = Spesialis::with('dokter')->find($id);
    
            return ApiFormatter::createAPI(200, 'Success', $spesialis);
        }
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