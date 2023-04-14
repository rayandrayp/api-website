<?php

namespace App\Http\Controllers\API;

use App\Models\PermintaanPPID;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PermintaanPPIDController extends Controller
{
    private function validator(array $data)
    {
        return Validator::make($data, [
            'kategori' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'metode_perolehan' => ['required', 'string', 'max:255'],
            'metode_pemberian' => ['required', 'string', 'max:255'],
            'rincian' => ['required', 'string', 'max:255'],
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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
            return ApiFormatter::createAPI(400, 'Failed', $validator->errors());
        }

        try {
            $file = $request->file('file');
            $path = 'user-id';
            // $lampiran->storeAs($path, $lampiran->hashName(), 'public');
            // $lampiran = Storage::disk('local')->put($file, 'Contents');
            $lampiran = Storage::put($path, $file);


            $permintaan_ppid = PermintaanPPID::create([
                'kategori' => $request->kategori,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'pekerjaan' => $request->pekerjaan,
                'phone' => $request->phone,
                'email' => $request->email,
                'metode_perolehan' => $request->metode_perolehan,
                'metode_pemberian' => $request->metode_pemberian,
                'rincian' => $request->rincian,
                // 'lampiran' => $path . '/' . $lampiran->hashName(),
                'lampiran' => $lampiran,
            ]);
        } catch (\Throwable $th) {
            return ApiFormatter::createAPI(500, 'Failed storing data.', $th->getMessage());
        }

        return ApiFormatter::createAPI(200, 'Success', $permintaan_ppid);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PermintaanPPID  $permintaanPPID
     * @return \Illuminate\Http\Response
     */
    public function show(PermintaanPPID $permintaanPPID)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermintaanPPID  $permintaanPPID
     * @return \Illuminate\Http\Response
     */
    public function edit(PermintaanPPID $permintaanPPID)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermintaanPPID  $permintaanPPID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermintaanPPID $permintaanPPID)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermintaanPPID  $permintaanPPID
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermintaanPPID $permintaanPPID)
    {
        //
    }
}