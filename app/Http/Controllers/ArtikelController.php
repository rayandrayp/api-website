<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_artikel = Artikel::orderBy('created_at', 'desc')->get();
        return view('artikel.index', compact('list_artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artikel.form');
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
            ]);

            $image = $request->file('banner');
            $path = '/images/artikel/';
            $image->storeAs($path, $image->hashName(), 'public');

            $artikel = Artikel::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => Str::slug($request->judul),
                'banner' =>  $path.$image->hashName(),
            ]);

            $data = Artikel::where('id', '=', $artikel->id)->get();
            if ($data.isEmpty()) {
                // return ApiFormatter::createAPI(400, 'Failed creating data.');
                return redirect()->back()->with('error', 'Artikel gagal ditambahkan');
                // return redirect('artikel/create')->with('error', 'Artikel gagal ditambahkan');
            }
        } catch (Exception $errmsg) {
            // return ApiFormatter::createAPI(400, 'Failed updating data.');
            return redirect()->back()->with('error', 'Artikel gagal ditambahkan');
            // return redirect('artikel/create')->with('error', 'Artikel gagal ditambahkan, Server error: '.$errmsg->getMessage());
        }
        // return ApiFormatter::createAPI(200, 'Success', $data);
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan');
        // return redirect('artikel')->with('success', 'Artikel berhasil ditambahkan');
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