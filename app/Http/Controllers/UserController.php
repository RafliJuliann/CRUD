<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan model User sudah ada
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua data pengguna
        return view('kelola.akun', compact('users')); // Tampilkan view daftar pengguna
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola.create_akun'); // Tampilkan form untuk membuat pengguna baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:users,nip',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    
        // Buat instansi baru dari model User dan simpan data
        User::create([
            'nama' => $request->input('nama'),
            'nip' => $request->input('nip'),
            'jabatan' => $request->input('jabatan'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Enkripsi password
        ]);
    
        // Redirect atau kembalikan respons
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Tampilkan detail pengguna jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mencari data pengguna berdasarkan ID
        $user = User::findOrFail($id);
        return view('user.edit_akun', compact('user')); // Tampilkan view edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diinput
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:users,nip,' . $id,
            'jabatan' => 'required|string|max:255',
        ]);

        // Update data pengguna
        $user = User::findOrFail($id);
        $user->nama = $request->input('nama');
        $user->nip = $request->input('nip');
        $user->jabatan = $request->input('jabatan');
        $user->save();

        // Redirect kembali ke daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari dan menghapus pengguna
        $user = User::findOrFail($id);
        $user->delete();
        
        // Redirect kembali ke daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
