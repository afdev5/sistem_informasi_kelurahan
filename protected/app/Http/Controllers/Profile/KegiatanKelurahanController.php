<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\KegiatanKelurahan;
use Auth;
use DataTables;
use Storage;

class KegiatanKelurahanController extends Controller
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
        return view('profile.kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.kegiatan.add');
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
            'gambar' => 'required',
            'judul' => 'required',
            'desc' => 'required',
            'tgl' => 'required',
        ]);
        $input = $request->except('gambar');
        $upload = $request->file('gambar');
        $input['gambar'] = $upload->store('kegiatan');
        $input['kelurahan_id'] = Auth::user()->kelurahan_id;
        KegiatanKelurahan::create($input);
        return redirect()->route('kegiatan_kelurahan.index');
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
        $data = KegiatanKelurahan::findOrFail($id);
        return view('profile.kegiatan.edit', compact('data'));
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
        $data = KegiatanKelurahan::findOrFail($id);
        $this->validate($request, [
            'judul' => 'required',
            'desc' => 'required',
            'tgl' => 'required',
        ]);
        $input = $request->except('gambar');
        $input['kelurahan_id'] = Auth::user()->kelurahan_id;
        if($request->hasFile('gambar')){
            Storage::delete($data->gambar);
            $upload = $request->file('gambar');
            $input['gambar'] = $upload->store('kegiatan');
        }
        $data->update($input);
        return redirect()->route('kegiatan_kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KegiatanKelurahan::findOrFail($id);
        Storage::delete($data->gambar);
        $data->delete();
        return redirect()->route('kegiatan_kelurahan.index');
    }

    public function datatable()
    {
        $data = KegiatanKelurahan::where('kelurahan_id', Auth::user()->kelurahan_id)->get();

            return Datatables::of($data)
            ->addColumn('action', function($data) {
                return view('datatable.action', [
                    'edit_url' => route('kegiatan_kelurahan.edit', $data->id),
                    'del_url'  => route('kegiatan_kelurahan.destroy', $data->id),
                ]);

            })
            ->addColumn('foto', function($data) {
                $url= asset('upload/'.$data->gambar);
                return '<img src="'.$url.'"  width="100" align="center" />';
            })
            ->addIndexColumn()->rawColumns(['foto', 'action'])->make(true);
    }
}
