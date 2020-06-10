<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use Auth;

class KelurahanProfileController extends Controller
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
        $data = Kelurahan::findOrFail(Auth::user()->kelurahan_id);
        return view('profile.profile_kelurahan', compact('data'));
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
        //
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
        $data = Kelurahan::findOrFail($id);
        $this->validate($request, [
            'kelurahan' => 'required',
            'kode_pos' => 'required',
            'alamat_kantor' => 'required',
            'email' => 'required|unique:tbl_kelurahan,email,' . $id,
            'website' => 'required',
            'no_telp' => 'required|unique:tbl_kelurahan,no_telp,' . $id,
        ]);
        $input = $request->all();
        $data->update($input);
        return redirect()->route('profile_kelurahan.index');
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
