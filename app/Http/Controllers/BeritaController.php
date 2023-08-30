<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    // next buat helper
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
        $list_berita = Berita::orderBy('created_at', 'desc')->get();
        return view('berita.index', compact('list_berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.form');
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
            $path = '/images/berita/';
            $image->storeAs($path, $image->hashName(), 'public');

            // generate slug from judul

            $berita = Berita::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => Str::slug($request->judul),
                'banner' =>  $path.$image->hashName(),
            ]);

            $data = Berita::where('id', '=', $berita->id)->get();
            if (is_null($data)) {
               return redirect()->back()->with('error', 'Berita gagal ditambahkan');
            }
        } catch (Exception $errmsg) {
            dd($errmsg->getMessage());
            return redirect()->back()->with('error', 'Berita gagal ditambahkan');
        }
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
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
        try {
            $berita = Berita::findOrFail($id);
            if ($berita) {
                try {
                    File::delete($this->absolutePath($data->banner));
                } catch (\Throwable $th) {
                    $fileNotExist = true;
                }
                $berita->delete();
                return ApiFormatter::createAPI(200, 'Success', $berita);
            } else {
                return ApiFormatter::createAPI(400, 'Failed data.');
            }
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, $errmsg->getMessage());
        }
    }
}