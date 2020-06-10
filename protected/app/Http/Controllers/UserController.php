<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kecamatan;
use App\Kelurahan;
use DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kec = Kecamatan::get();
        return view('admin.user.add', compact('kec'));
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
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'kelurahan_id' => 'required',
        ]);
        $input = $request->except('password');
        $input['password'] = bcrypt($request->password);
        $input['level'] = '2';
        User::create($input);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     * Get Data Kelurahan 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($id)
    {
        $data = Kelurahan::where('kecamatan_id', $id)->get();
        $return = '<option>Pilih Kelurahan</option>';
        foreach($data as $kel){
            $return .= "<option value='$kel->id'>$kel->kelurahan</option>";
        }
        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        // $pass = Hash::
        $kec = Kecamatan::get();
        return view('admin.user.edit', compact('data', 'kec'));
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
        $data = User::findOrFail($id);
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'required',
        ]);
        $input = $request->except('password');
        $input['password'] = bcrypt($request->password);
        $data->update($input);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('user.index');
    }


    public function datatable()
    {
        $user = User::where('level', 2)->get();

        return Datatables::of($user)
            ->addColumn('kelurahan', function($user) {
                return $user->kelurahan['kelurahan'];
            })
            ->addColumn('action', function($user) {
                return view('datatable.action', [
                    'edit_url' => route('user.edit', $user->id),
                    'del_url'  => route('user.destroy', $user->id),
                ]);

            })
            ->addIndexColumn()->make(true);
    }
}
