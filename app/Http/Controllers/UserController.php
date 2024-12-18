<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view ('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:5', 'confirmed',
            'no_telp' =>  'required|digits_between:10,15',
            'alamat'    =>  'required|string|min:5|max:255',
            'nama_provinsi' =>  'required|string|min:5|max:255',
            'nama_kota' =>  'required|string|min:5|max:255',
            'kode_pos'  => 'required|digits_between:1,10',

        ]);

        User::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=> Hash::make($request->get('password')),
            'no_telp'=>$request->get('no_telp'),
            'alamat'=>$request->get('alamat'),
            'nama_provinsi'=>$request->get('nama_provinsi'),
            'nama_kota'=>$request->get('nama_kota'),
            'kode_pos'=>$request->get('kode_pos'),
            'role'=>$request->get('role'),
        ]);
        return redirect()->back()->with('message', 'User berhasil ditambahkan');
    }


    public function edit($id)
    {
        $users = User::find($id);
        return view ('users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'nullable', 'string', 'min:5', 'confirmed',
           'no_telp' =>  'required|digits_between:10,15',
           'alamat'    =>  'required|string|min:5|max:255',
           'nama_provinsi' =>  'required|string|min:5|max:255',
           'nama_kota' =>  'required|string|min:5|max:255',
           'kode_pos'  => 'required|digits_between:1,10',
        ]);
        
        $users = User::find($id);
        $users->name = $request->get('name');
        $users->email = $request->get('email');
        $users->no_telp = $request->get('no_telp');
        $users->alamat = $request->get('alamat');
        $users->nama_provinsi = $request->get('nama_provinsi');
        $users->nama_kota = $request->get('nama_kota');
        $users->kode_pos = $request->get('kode_pos');
        if ($request->filled('password')) {
            $users->password = Hash::make($request->get('password'));
        }
        if ($request->filled('role')) {
            $users->role = $request->get('role');;
        }
        $users->save();
        return redirect()->back()->with('message', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('message', 'User berhasil dihapus');
    }
}