<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kecamatan;
use App\Kelurahan;
use App\Penduduk;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        if(Auth::user()->level == 1){
            $admin = User::where('level', 2)->count();
            $kec = Kecamatan::count();
            $kel = Kelurahan::count();
            $penduduk = Penduduk::count();
            return view('home', compact('admin', 'kec', 'kel', 'penduduk'));
        }
        else{
            $penduduk = Penduduk::where('kelurahan_id', Auth::user()->kelurahan_id)->count();
            $perempuan = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id], ['jenis_kelamin', 2]])->count();
            $pria = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id], ['jenis_kelamin', 1]])->count();
            $anak = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id], ['umur', '<=', 17]])->count();
            return view('home', compact('penduduk', 'perempuan', 'pria', 'anak'));
        }
    }
}
