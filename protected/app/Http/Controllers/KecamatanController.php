<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use DataTables;

class KecamatanController extends Controller
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
        return view('admin.kecamatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kecamatan.add');
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
            'kecamatan' => 'required',
        ]);
        $input = $request->all();
        Kecamatan::create($input);
        return redirect()->route('kecamatan.index');
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
        $data = Kecamatan::findOrFail($id);
        return view('admin.kecamatan.edit', compact('data'));
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
        $data = Kecamatan::findOrFail($id);
        $this->validate($request, [
            'kecamatan' => 'required',
        ]);
        $input = $request->all();
        $data->update($input);
        return redirect()->route('kecamatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kecamatan::findOrFail($id);
        $data->delete();
        return redirect()->route('kecamatan.index');
    }

    public function datatable()
    {
        $data = Kecamatan::all();

        return Datatables::of($data)
            ->addColumn('action', function($data) {
                return view('datatable.action', [
                    'edit_url' => route('kecamatan.edit', $data->id),
                    'del_url'  => route('kecamatan.destroy', $data->id),
                ]);

            })
            ->addIndexColumn()->make(true);
    }
}
