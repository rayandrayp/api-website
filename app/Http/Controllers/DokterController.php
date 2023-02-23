<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\Dokter;

class DokterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'nm_dokter' => ['required', 'string', 'max:255'],
            'kd_sps' => ['required', 'string', 'max:255'],
            'foto' => ['', '', '', 'max:2048'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_dokter = Dokter::with('spesialis','minat_klinis','prestasi','pendidikan')->get();
        return view('dokter.index', compact('list_dokter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_spesialis = \App\Models\Spesialis::all();
        return view('dokter.form', compact('list_spesialis'));
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
            return response()->json(['error' => $validator->errors()], 400);
        }

        try{
            $image = $request->file('foto');
            $path = '/images/dokter/';
            if($image){
                $image->storeAs($path, $image->hashName(), 'public');
            }

            $dokter = Dokter::create([
                'kd_dokter' => $request->kd_dokter,
                'nm_dokter' => $request->nm_dokter,
                'kd_sps' => $request->kd_sps,
                'imagepath' => ($image)? $path.$image->hashName() : null,
            ]);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // return response()->json(['success' => 'Berhasil menambahkan data'], 200);
        // return response with $dokter
        return response()->json(['success' => 'Berhasil menambahkan data', 'data' => $dokter], 200);
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
        $dokter = Dokter::find($id);
        if(!$dokter){
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $list_spesialis = \App\Models\Spesialis::all();
        return view('dokter.edit', compact('dokter', 'list_spesialis'));
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
        // $validator = $this->validator($request->all());
        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 400);
        // }

        try{
            $dokter = Dokter::find($id);
            if(!$dokter){
                return response()->json(['error' => 'Data tidak ditemukan'], 404);
            }
            $image = $request->file('foto');
            $path = '/images/dokter/';
            if($image){
                $image->storeAs($path, $image->hashName(), 'public');
                $dokter->update([
                    'nm_dokter' => $request->nm_dokter,
                    'kd_sps' => $request->kd_sps,
                    'imagepath' => ($image)? $path.$image->hashName() : $dokter->imagepath,
                ]);
            }else{
                $dokter->update([
                    'nm_dokter' => $request->nm_dokter,
                    'kd_sps' => $request->kd_sps,
                ]);
            }
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Berhasil mengubah data', 'data' => $dokter], 200);
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