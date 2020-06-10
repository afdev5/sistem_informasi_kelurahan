<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\Kelurahan;
use App\Struktur_Kelurahan;
use App\User;
use DataTables;

class KelurahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kelurahan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kecamatan::all();
        return view('admin.kelurahan.add', compact('data'));
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
            'kecamatan_id' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
            'alamat_kantor' => 'required',
            'email' => 'required|unique:tbl_kelurahan',
            'website' => 'required',
            'no_telp' => 'required|unique:tbl_kelurahan'
        ]);
        $input = $request->all();
        Kelurahan::create($input);
        return redirect()->route('kelurahan.index');
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
        $data = Kelurahan::findOrFail($id);
        $a = Kecamatan::all();
        return view('admin.kelurahan.edit', compact('data', 'a'));
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
            'kecamatan_id' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
            'alamat_kantor' => 'required',
            'email' => 'required|unique:tbl_kelurahan,email,' . $id,
            'website' => 'required',
            'no_telp' => 'required|unique:tbl_kelurahan,no_telp,' . $id,
        ]);
        $input = $request->all();
        $data->update($input);
        return redirect()->route('kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kelurahan::findOrFail($id);
        $data->delete();
        return redirect()->route('kelurahan.index');
    }

    public function datatable()
    {
        $data = Kelurahan::all();

        return Datatables::of($data)
            ->addColumn('kecamatan', function($data) {
                return $data->kecamatan['kecamatan'];
            })
            ->addColumn('action', function($data) {
                return view('datatable.action', [
                    'edit_url' => route('kelurahan.edit', $data->id),
                    'del_url'  => route('kelurahan.destroy', $data->id),
                ]);

            })
            ->addIndexColumn()->make(true);
    }
}
