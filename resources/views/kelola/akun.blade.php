@extends('layouts.app')

{{-- @section('title', 'Daftar Pegawai') --}}

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Kelola Akun</h1>

        <!-- Tombol untuk menambah pegawai -->
        <div class="mb-4 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pegawai</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Gunakan forelse untuk menampilkan data atau pesan jika tidak ada data -->
                    @forelse($users as $users)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $users->nama }}</td>
                            <td>{{ $users->nip }}</td>
                            <td>{{ $users->gender }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('users.edit', $users->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('users.destroy', $users->id) }}" method="POST" class="d-inline" id="delete-form-{{ $users->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $users->id }}')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data pegawai tidak tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                document.getElementById('delete-form-' + id).submit();
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    }
    </script>
@endsection
