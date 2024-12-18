<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'alamat'    =>  'required|string|min:5|max:255',
            'nama_provinsi' =>  'required|string|min:5|max:255',
            'nama_kota' =>  'required|string|min:5|max:255',
            'kode_pos'  => 'required|digits_between:1,10',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat'=>$request->alamat,
            'nama_provinsi'=>$request->nama_provinsi,
            'nama_kota'=>$request->nama_kota,
            'kode_pos'=>$request->kode_pos,
            
        ]);

        return redirect()->route('login')->with('success', 'Registration successful, please login.');
    }
}
