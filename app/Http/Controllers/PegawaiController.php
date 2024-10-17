<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = pegawai::all();
        return view('dawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:pegawais,nip',
            'gender' => 'required',
        ]);

        // Buat instansi baru dari model Pegawai dan simpan data
        pegawai::create([
            'nama' => $request->input('nama'),
            'nip' => $request->input('nip'),
            'gender' => $request->input('gender'),
        ]);

        // Redirect atau kembalikan respons, misalnya ke halaman daftar pegawai
        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mencari data pegawai berdasarkan ID
        $pegawai = pegawai::findOrFail($id);

        // Mengarahkan ke view 'edit' dan mengirimkan data pegawai
        return view('dawai.edit', compact('pegawai'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diinput
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric',
            'gender' => 'required|string|max:255',
        ]);

        // Update data pegawai
        $pegawai = pegawai::findOrFail($id);

        $pegawai->nama = $request->input('nama');
        $pegawai->nip = $request->input('nip');
        $pegawai->gender = $request->input('gender');
        $pegawai->save();

        // Redirect kembali ke daftar pegawai dengan pesan sukses
        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diupdate.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pegawai = pegawai::findOrFail($id);
        $pegawai->delete();
        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
