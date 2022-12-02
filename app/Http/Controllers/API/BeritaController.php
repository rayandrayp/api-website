<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Exception;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Berita::all();
        if ($data) {
            return ApiFormatter::createAPI(200, 'Success', $data);
        } else {
            return ApiFormatter::createAPI(400, 'Failed loading data.');
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
        try {
            $request->validate([
                'judul' => 'required',
                'isi' => 'required',
                'slug' => 'required'
            ]);

            $berita = Berita::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => $request->slug
            ]);

            $data = Berita::where('id', '=', $berita->id)->get();
            if ($data) {
                return ApiFormatter::createAPI(200, 'Success', $data);
            } else {
                return ApiFormatter::createAPI(400, 'Failed creating data.');
            }
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed updating data.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Berita::where('id', '=', $id)->get();
        if ($data) {
            return ApiFormatter::createAPI(200, 'Success', $data);
        } else {
            return ApiFormatter::createAPI(400, 'Failed retrieving data.');
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
        try {
            $request->validate([
                'judul' => 'required',
                'isi' => 'required',
                'slug' => 'required'
            ]);

            $berita = Berita::findOrFail($id);

            $data = $berita->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => $request->slug
            ]);

            if ($data) {
                return ApiFormatter::createAPI(200, 'Success', $data);
            } else {
                return ApiFormatter::createAPI(400, 'Failed updating data.');
            }
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed updating data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $data = $berita->delete();
            if ($data) {
                return ApiFormatter::createAPI(200, 'Success', $data);
            } else {
                return ApiFormatter::createAPI(400, 'Failed deleting data.');
            }
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed deleting data.');
        }
    }
}
