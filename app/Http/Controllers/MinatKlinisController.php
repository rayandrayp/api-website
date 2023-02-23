<?php

namespace App\Http\Controllers;

use App\Models\MinatKlinis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MinatKlinisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        try{
            $minat = MinatKlinis::create($request->all());
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Minat Klinis berhasil ditambahkan', 'data' => $minat], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MinatKlinis  $minatKlinis
     * @return \Illuminate\Http\Response
     */
    public function show(MinatKlinis $minatKlinis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MinatKlinis  $minatKlinis
     * @return \Illuminate\Http\Response
     */
    public function edit(MinatKlinis $minatKlinis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MinatKlinis  $minatKlinis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MinatKlinis $minatKlinis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MinatKlinis  $minatKlinis
     * @return \Illuminate\Http\Response
     */
    public function destroy(MinatKlinis $minatKlinis, $id)
    {
        try{
            $minat = MinatKlinis::find($id);
            $minat->delete();
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Minat Klinis berhasil dihapus'], 200);
    }
}