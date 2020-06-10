<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Penduduk;
use App\Kelurahan;
use Auth;
use DataTables;
use Excel;
use Storage;

class PendudukController extends Controller
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
        if(Auth::user()->level == 1){
            $data = Kelurahan::all();
            return view('penduduk.index', compact('data'));
        }
        else{
            return view('penduduk.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Jika yg login adalah superadmin
        if(Auth::user()->level == 1){
            $data = Kelurahan::all();
            return view('penduduk.add', compact('data'));
        }
        else{
            return view('penduduk.add');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Jika yg login adalah superadmin
        $this->validate($request, [
            'kelurahan_id' => 'required',
            'nik' => 'required|unique:tbl_penduduk',
            'nama' => 'required',
            'no_kk' => 'required|unique:tbl_penduduk',
            'jenis_kelamin' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat' => 'required',
            'lingkungan' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'pendidikan' => 'required',
            'umur' => 'required',
            'pekerjaan' => 'required',
            'status_kawin' => 'required',
            'agama' => 'required',
            'tl' => 'required',
            'tgl' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        Penduduk::create($input);
        return redirect()->route('penduduk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penduduk::findOrFail($id);
        return view('penduduk.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Penduduk::findOrFail($id);
        return view('penduduk.edit', compact('data'));
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
        $data = Penduduk::findOrFail($id);
        $this->validate($request, [
            'nik' => 'required|unique:tbl_penduduk,nik,' . $id,
            'nama' => 'required',
            'no_kk' => 'required|unique:tbl_penduduk,no_kk,' . $id,
            'jenis_kelamin' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat' => 'required',
            'lingkungan' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'pendidikan' => 'required',
            'umur' => 'required',
            'pekerjaan' => 'required',
            'status_kawin' => 'required',
            'agama' => 'required',
            'tl' => 'required',
            'tgl' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $data->update($input);
        return redirect()->route('penduduk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Penduduk::findOrFail($id);
        $data->delete();
        return redirect()->route('penduduk.index');
    }

    public function datatable()
    {
        
        // Jika yg login adalah superadmin
        if(Auth::user()->level == 1){
            // return $data = DB::table('tbl_penduduk')
            //                 ->whereRaw('status = 1')
            //                 ->join('tbl_kelurahan', 'tbl_penduduk.kelurahan_id',  '=', 'tbl_kelurahan.id')
            //                 ->get();
            // return Datatables::of($data)
            // ->addColumn('jk', function($data) {
            //     if($data->jenis_kelamin == 1){
            //         return 'Laki - Laki';
            //     }
            //     else{
            //         return 'Perempuan';
            //     }
            // })
            // ->addColumn('action', function($data) {
            //     return view('datatable.action_show', [
            //         'show_url' => route('penduduk.show', $data->id),
            //         'edit_url' => route('penduduk.edit', $data->id),
            //         'del_url'  => route('penduduk.destroy', $data->id),
            //     ]);

            // })
            // ->addIndexColumn()->make(true);
        }
        else{
            $data = Penduduk::where([['kelurahan_id', Auth::user()->kelurahan_id],['status', 1]])->get();

            return Datatables::of($data)
            ->addColumn('action', function($data) {
                return view('datatable.action_show', [
                    'show_url' => route('penduduk.show', $data->id),
                    'edit_url' => route('penduduk.edit', $data->id),
                    'del_url'  => route('penduduk.destroy', $data->id),
                ]);

            })
            ->addColumn('jk', function($data) {
                if($data->jenis_kelamin == 1){
                    return 'Laki - Laki';
                }
                else{
                    return 'Perempuan';
                }
            })
            ->addIndexColumn()->make(true);
        }
        
    }

    // Datatable Sesuai Kelurahan
    public function kelurahan(Request $request)
    {
        $id = $request->kelurahan_id;
        $data = Kelurahan::all();
        $kel = Kelurahan::select('kelurahan')->where('id', $id)->first();
        return view('penduduk.kelurahan', compact('id', 'data', 'kel'));
    }
    public function dt($id)
    {
        $data = Penduduk::where([['status', 1],['kelurahan_id', $id]])->get();

        return Datatables::of($data)
        ->addColumn('kecamatan', function($data) {
            return $data->kelurahan->kecamatan['kecamatan'];
        })
        ->addColumn('kelurahan', function($data) {
            return $data->kelurahan['kelurahan'];
        })
        ->addColumn('jk', function($data) {
            if($data->jenis_kelamin == 1){
                return 'Laki - Laki';
            }
            else{
                return 'Perempuan';
            }
        })
        ->addColumn('action', function($data) {
            return view('datatable.action_show', [
                'show_url' => route('penduduk.show', $data->id),
                'edit_url' => route('penduduk.edit', $data->id),
                'del_url'  => route('penduduk.destroy', $data->id),
            ]);

        })->addIndexColumn()->make(true);   
    }

    public function export()
    {
        if(Auth::user()->level == 1){
            $data = Penduduk::all();
            return Excel::create('data_penduduk', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data){
                $sheet->fromArray($data);
            });
            })->download('xlsx');
        }
        else{
            $data = Penduduk::where('kelurahan_id', Auth::user()->kelurahan_id)->get();
            return Excel::create('data_penduduk', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data){
                $sheet->fromArray($data);
            });
            })->download('xlsx');
        }
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'kelurahan_id' => 'required',
        ]);
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()){
                foreach($data as $key => $value) {
                    // if($value->nik != null){
                        $penduduk = new Penduduk();
                        $penduduk->kelurahan_id = $request->kelurahan_id;
                        $penduduk->nik = $value->nik;
                        $penduduk->nama = $value->nama;
                        $penduduk->tl = $value->tempat_lahir;
                        $penduduk->tgl = $value->tgl_lahir;
                        $penduduk->no_kk = $value->no_kk;
                        $penduduk->jenis_kelamin = $value->jenis_kelamin;
                        $penduduk->nama_ayah = $value->nama_ayah;
                        $penduduk->nama_ibu = $value->nama_ibu;
                        $penduduk->alamat = $value->alamat;
                        $penduduk->lingkungan = $value->lingkungan;
                        $penduduk->rw = $value->rw;
                        $penduduk->rt = $value->rt;
                        $penduduk->pendidikan = $value->pendidikan_terakhir;
                        $penduduk->umur = $value->umur;
                        $penduduk->pekerjaan = $value->pekerjaan;
                        $penduduk->status_kawin = $value->status_perkawinan;
                        $penduduk->agama = $value->agama;
                        $penduduk->status = $value->status_kematian;
                        $penduduk->save();
                    // }
                }
            }
        }
        return back();
        // return redirect()->route('home');
    }

    public function format()
    {
        return Storage::download('format.xlsx');
    }
}
