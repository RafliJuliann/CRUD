@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Tambah Pegawai Baru</h1>

        <!-- Tampilkan error validasi jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk menambahkan pegawai -->
        <form action="{{ route('pegawais.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <!-- Input Nama -->
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pegawai->nama }}" placeholder="Masukkan nama pegawai" required>
            </div>

            <!-- Input NIP -->
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="number" class="form-control" id="nip" name="nip" value="{{ $pegawai->nip }}" placeholder="Masukkan NIP pegawai" required>
            </div>


            <!-- Input NIP -->
            <div class="form-group">
                <label for="gender">gender</label>
                <input type="text" class="form-control" id="gender" name="gender" value="{{ $pegawai->gender }}" placeholder="Masukkan NIP pegawai" required>
            </div>

           

              <!-- Tombol Submit -->
              <button type="submit" class="btn btn-primary">Simpan</button>
              <!-- Tombol Back -->
              <a href="{{ route('pegawais.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
