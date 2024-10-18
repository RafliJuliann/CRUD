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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,pegawai',
        ]);
    
        // Buat instansi baru dari model User dan simpan data
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Enkripsi password
            'role' => $request->input('role'),
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
        return view('kelola.edit_akun', compact('user')); // Tampilkan view edit
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, string $id)
     {
         $request->validate([
             'name' => 'required|max:100',
             'email' => 'required|email|unique:users,email,' . $id,
             'role' => 'required',
             'password' => 'nullable', // Password bersifat opsional karna nullable
 
         ]);
 
         // Mencari user berdasarkan ID jika tidak di temukan berarti fail atau 404
         $users = User::findOrFail($id);
 
         // Update data user berdasarkan inputan form
         // name, email dan role di update berdasarkan inputan form
         $users->name = $request->name;
         $users->email = $request->email;
         $users->role = $request->role;
 
         // Jika password diisi, maka lakukan enkripsi dan update bersifat opsional
         if ($request->filled('password')) {
             $users->password = bcrypt($request->password);
         }
 
         // function untuk Simpan perubahan ke databasenya
         $users->save();
 
         // akan mengarahkan ke halaman data user bersama session succes dengan pesan berhasil jika update succes
         return redirect()->route('users.index')->with('success', 'Berhasil mengupdate akun!');
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
