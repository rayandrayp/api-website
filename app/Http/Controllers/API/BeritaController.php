<?php

namespace App\Http\Controllers\API;

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
        $data = Berita::orderBy('created_at', 'desc')->paginate(10);
        if ($data) {
            return ApiFormatter::createAPI(200, 'Success', $data);
        } else {
            return ApiFormatter::createAPI(400, 'Failed loading data.');
        }
    }

    /**
     * Display a listing of the popular resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPopular()
    {
        // get popular berita within 7 days
        $data = Berita::orderBy('views', 'desc')
                // ->where('created_at', '>=', now()->subDays(7))
                ->take(5)
                ->get();
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
        $data = Berita::find($id);
        // Update views
        $data->views++;
        $data->save();

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
            if ($berita) {
                try {
                    File::delete($this->absolutePath($data->banner));
                } catch (\Throwable $th) {
                    $fileNotExist = true;
                }
                $berita->delete();
                return ApiFormatter::createAPI(200, 'Success', $data);
            } else {
                return ApiFormatter::createAPI(400, 'Failed deleting data.');
            }
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed deleting data.');
        }
    }
}