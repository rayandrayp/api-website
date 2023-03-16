<?php

namespace App\Http\Controllers;

use App\Models\ResponPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ResponPengaduanController extends Controller
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
        $validator = Validator::make($request->all(), [
            'pengaduan_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $this->data['pengaduan'] = Pengaduan::find($request->pengaduan_id);
        
        if(!$this->data['pengaduan']){
            return response()->json([
                'status' => 'error',
                'message' => 'Data pengaduan tidak ditemukan'
            ], 404);
        }

        if($this->data['pengaduan']->status == 1){
            return response()->json([
                'status' => 'error',
                'message' => 'Pengaduan sudah direspon oleh :'.$this->data['pengaduan']->respon_pengaduan->user->name,
            ], 400);
        }

        // insert respon pengaduan
        try {
            $this->data['respon_pengaduan'] = ResponPengaduan::create([
                'pengaduan_id' => $request->pengaduan_id,
                'user_id' => Auth::user()->id,
                'respon' => $request->respon,
            ]);
            $this->data['pengaduan']->update([
                'status' => 1,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambahkan respon pengaduan',
            'data' => $this->data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResponPengaduan  $responPengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(ResponPengaduan $responPengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResponPengaduan  $responPengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(ResponPengaduan $responPengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResponPengaduan  $responPengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResponPengaduan $responPengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResponPengaduan  $responPengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResponPengaduan $responPengaduan)
    {
        //
    }
}