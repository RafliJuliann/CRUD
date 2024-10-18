@extends('layouts.app')

{{-- @section('title', 'Daftar Pegawai') --}}

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kelola Akun</h1>

        <!-- Tombol untuk menambah pegawai -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Daftar Pegawai</h4>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pegawai</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>

                                        <button type="button" class="btn btn-danger btn-sm mx-1" 
                                            onclick="confirmDelete('{{ $user->id }}')">Delete</button>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-none" id="delete-form-{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Data pegawai tidak tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                    Swal.fire(
                        'Terhapus!',
                        'Data pegawai telah dihapus.',
                        'success'
                    )
                }
            });
        }
    </script>
@endsection
