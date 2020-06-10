<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\Struktur_Kelurahan;
use Auth;
use DataTables;
use Storage;

class StrukturKelurahanController extends Controller
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
        return view('profile.struktur.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.struktur.add');
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
            'nama_pegawai' => 'required',
            'nip_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'level_jabatan' => 'required',
            'gambar' => 'required',

        ]);
        $input = $request->except('gambar');
        $input['kelurahan_id'] = Auth::user()->kelurahan_id;
        if($request->hasFile('gambar')){
            $upload = $request->file('gambar');
            $input['gambar'] = $upload->store('struktur/'.Auth::user()->kelurahan['kelurahan']);
        }
        Struktur_Kelurahan::create($input);
        return redirect()->route('struktur_kelurahan.index');
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
        $data = Struktur_Kelurahan::findOrFail($id);
        return view('profile.struktur.edit', compact('data'));
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
        $data = Struktur_Kelurahan::findOrFail($id);
        $this->validate($request, [
            'nama_pegawai' => 'required',
            'nip_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'jabatan' => 'required',
            'level_jabatan' => 'required',

        ]);
        $input = $request->except('gambar');
        if($request->hasFile('gambar')){
            Storage::delete($data->gambar);
            $upload = $request->file('gambar');
            $input['gambar'] = $upload->store('struktur/'.Auth::user()->kelurahan['kelurahan']);
        }
        $data->update($input);
        return redirect()->route('struktur_kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Struktur_Kelurahan::findOrFail($id);
        if($data->gambar != null){
            Storage::delete($data->gambar);
        }
        $data->delete();
        return redirect()->route('struktur_kelurahan.index');
    }

    public function datatable()
    {
        $data = Struktur_Kelurahan::where('kelurahan_id', Auth::user()->kelurahan_id)->orderBy('level_jabatan', 'ASC')->get();

            return Datatables::of($data)
            ->addColumn('action', function($data) {
                return view('datatable.action', [
                    'edit_url' => route('struktur_kelurahan.edit', $data->id),
                    'del_url'  => route('struktur_kelurahan.destroy', $data->id),
                ]);

            })
            ->addColumn('jab', function($data){
                if($data->level_jabatan == 0){
                    return 'Lurah';
                }
                elseif($data->level_jabatan == 1){
                    return 'Sekretaris';
                }
                elseif($data->level_jabatan == 2){
                    return 'Kasie. Pemerintahan & Trantib';
                }
                elseif($data->level_jabatan == 3){
                    return 'Kasie. Pembangunan';
                }
                elseif($data->level_jabatan == 4){
                    return 'Kasie. Keuangan';
                }
                else{
                    return 'Kasie. Kesra';
                }

            })
            ->addColumn('jk', function($data){
                if($data->jenis_kelamin == 1){
                    return 'Laki-laki';
                }
                elseif($data->jenis_kelamin == 2){
                    return 'Perempuan';
                }
            })
            ->addColumn('foto', function($data) {
                $url= asset('upload/'.$data->gambar);
                return '<img src="'.$url.'"  width="100" align="center" />';
            })
            ->addIndexColumn()->rawColumns(['foto', 'action'])->make(true);
    }
}
