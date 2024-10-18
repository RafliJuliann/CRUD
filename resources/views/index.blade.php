@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center h-80 bg-dark text-white" 
        style="background-color: #032B44; background-size: cover;">
        
        <div class="text-center">
            <h1 class="display-3 font-weight-bold">Selamat Datang di Sistem Data Pegawai</h1>
            <p class="lead mb-4">Kelola data pegawai Anda dengan mudah, cepat, dan aman.</p>

            <!-- Row dengan 3 kolom fitur -->
            <div class="row text-center justify-content-center mb-4">
                <div class="col-md-4 mb-4">
                    <div class="card bg-light shadow">
                        <div class="card-body">
                            <i class="bi bi-person-circle display-4 text-primary mb-3"></i>
                            <h5 class="card-title">Kelola Akun</h5>
                            <p class="card-text">Atur informasi akun pegawai dan tingkatkan efisiensi pekerjaan Anda.</p>
                            <a href="{{ route('pegawais.index') }}" class="btn btn-primary">Lihat Data Pegawai</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card bg-light shadow">
                        <div class="card-body">
                            <i class="bi bi-bar-chart-fill display-4 text-primary mb-3"></i>
                            <h5 class="card-title">Laporan dan Analisis</h5>
                            <p class="card-text">Pantau kinerja pegawai dan hasilkan laporan terperinci secara real-time.</p>
                            <a href="{{ route('users.index') }}" class="btn btn-primary">Lihat data akun</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol tambahan di bawah fitur -->
            <a href="{{ route('pegawais.index') }}" class="btn btn-light btn-lg shadow-sm">Mulai Kelola Pegawai</a>
        </div>
    </div>
@endsection
