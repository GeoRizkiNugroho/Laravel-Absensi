<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('name', 'ASC')->simplePaginate(5);
        return view('user.index', compact('users'));
    }


    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email', // Tambahkan validasi unik
            'role' => 'required',
            'password' => 'required|min:6', // Pastikan juga password divalidasi
        ]);

        // Buat pengguna baru jika validasi lolos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Berhasil menambahkan data user!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required',
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diubah.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }


    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $users = $request->only(['email', 'password']);
        if (auth()->attempt($users)) {
            return redirect()->route('home')->with('success', 'Login berhasil');
        } else {
            return redirect()->route('login')->with('failed', 'Login gagal');
        }
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}



