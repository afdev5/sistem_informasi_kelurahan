<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add');
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
        ]);
        $input = $request->except('password');
        $input['password'] = bcrypt($request->password);
        $input['level'] = '2';
        $input['kelurahan_id'] = '1';
        User::create($input);
        return redirect()->route('user.index');
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
        $data = User::findOrFail($id);
        // $pass = Hash::
        return view('user.edit', compact('data'));
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
