<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wilayah;
use Auth;
use DataTables;

class WilayahKelurahanController extends Controller
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
        return view('profile.wilayah.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.wilayah.add');
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
            'bagian' => 'required',
            'batas' => 'required',
        ]);
        $input = $request->all();
        $input['kelurahan_id'] = Auth::user()->kelurahan_id;
        Wilayah::create($input);
        return redirect()->route('wilayah.index');
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
        $data = Wilayah::findOrFail($id);
        return view('profile.wilayah.edit', compact('data'));
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
        $data = Wilayah::findOrFail($id);
        $this->validate($request, [
            'bagian' => 'required',
            'batas' => 'required',
        ]);
        $input = $request->all();
        $data->update($input);
        return redirect()->route('wilayah.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Wilayah::findOrFail($id);
        $data->delete();
        return redirect()->route('wilayah.index');
    }

    public function datatable()
    {
        $data = Wilayah::where('kelurahan_id', Auth::user()->kelurahan_id)->get();

            return Datatables::of($data)
            ->addColumn('action', function($data) {
                return view('datatable.action', [
                    'edit_url' => route('wilayah.edit', $data->id),
                    'del_url'  => route('wilayah.destroy', $data->id),
                ]);

            })
            ->addColumn('bag', function($data) {
                if($data->bagian == 1){
                    return 'Utara';
                }
                elseif($data->bagian == 2){
                    return 'Timur';
                }
                elseif($data->bagian == 3){
                    return 'Selatan';
                }
                else{
                    return 'Barat';
                }

            })
            ->addIndexColumn()->make(true);
    }
}
