<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['list_pengaduan_spi'] = \App\Models\LaporanSPI::all();
        $this->data['list_pengaduan'] = \App\Models\Pengaduan::all();
        $this->data['list_ulasan'] = \App\Models\Review::all();
        return view('dashboard.index', $this->data);
    }
}