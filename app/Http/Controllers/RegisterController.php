<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'username' => 'required|min:3|max:255|unique:users',
        'email' => 'required|email:dns|max:255|unique:users',
        'password' => 'required|min:5|max:255',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);
    User::create($validatedData);

    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
}

}


        // Simpan data pengguna baru ke database
        // $user = new \App\Models\User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // $user->save();

