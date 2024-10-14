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
        ]);

        User::create([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=> Hash::make($request->get('password')),
            'role'=>$request->get('role'),
        ]);
        return redirect()->back()->with('message', 'User berhasil ditambahkan');
    }

    public function show($id)
    {
        //
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
        ]);
        
        $users = User::find($id);
        $users->name = $request->get('name');
        $users->email = $request->get('email');
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
