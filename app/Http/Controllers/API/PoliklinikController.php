<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;


class PoliklinikController extends Controller
{

    private function validator(array $data)
    {
        return Validator::make($data, [
            'kd_poli' => ['required', 'string', 'max:255'],
            'nm_poli' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string'],
            'banner' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
    }

    private function absolutePath($path)
    {
        return str_replace('\\', '/', public_path('storage/'.$path));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Poliklinik::all();
        if ($data) {
            return ApiFormatter::createAPI(200, 'Success', $data);
        } else {
            return ApiFormatter::createAPI(400, 'Failed retrieving data.');
        }
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
            return ApiFormatter::createAPI(422, 'Failed retrieving data.', $validator->errors());
        }
        try {
            $image = $request->file('banner');
            $path = '/images/poliklinik/';
            $image->storeAs($path, $image->hashName(), 'public');
            
            $poliklinik = Poliklinik::create([
                'kd_poli' => $request->kd_poli,
                'nm_poli' => $request->nm_poli,
                'keterangan' => $request->keterangan,
                'banner' =>  $path.$image->hashName(),
            ]);
        } catch (\Throwable $th) {
            return ApiFormatter::createAPI(400, 'Failed updating data.', $th);
        }

        return ApiFormatter::createAPI(200, 'Success', $poliklinik);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function show($kd_poli)
    {
        $data = Poliklinik::where('kd_poli', '=', $kd_poli)->first();

        if ($data) {
            return ApiFormatter::createAPI(200, 'Success', $data);
        } else {
            return ApiFormatter::createAPI(400, 'Failed retrieving data.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poliklinik  $poliklinik
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
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function destroy($kd_poli)
    {
        $data = Poliklinik::where('kd_poli', '=', $kd_poli)->first();
        if ($data) {
            try {
                File::delete($this->absolutePath($data->banner));
            } catch (\Throwable $th) {
                $fileNotExist = true;
            }
            $data->delete();
            return ApiFormatter::createAPI(200, 'Success', $data);
        } else {
            return ApiFormatter::createAPI(400, 'Failed retrieving data.');
        }
    }
}