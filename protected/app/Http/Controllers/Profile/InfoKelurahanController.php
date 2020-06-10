<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InfoKelurahan;
use Auth;

class InfoKelurahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('operator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InfoKelurahan::where('kelurahan_id', Auth::user()->kelurahan_id)->first();
        // return $data;
        return view('profile.info_kelurahan', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kelurahan_id' => 'required|unique:tbl_infokelurahan',
            'visi' => 'required',
            'misi' => 'required',
            'sejarah' => 'required',
        ]);
        $input = $request->all();
        InfoKelurahan::create($input);
        return redirect()->route('info_kelurahan.index');
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
        $data = InfoKelurahan::findOrFail($id);
        $this->validate($request, [
            'visi' => 'required',
            'misi' => 'required',
            'sejarah' => 'required',
        ]);
        $input = $request->all();
        $data->update($input);
        return redirect()->route('info_kelurahan.index');
    }
}
