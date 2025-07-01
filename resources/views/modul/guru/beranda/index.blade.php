@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info d-flex justify-content-between align-items-center shadow-sm">
                <div>
                    <h5 class="mb-1">Selamat Datang, {{ session('nama') ?? 'Guru' }}!</h5>
                    <p class="mb-0">Anda login sebagai Guru. Berikut ringkasan informasi Anda.</p>
                </div>

                <!-- Icon Profil + Dropdown Logout -->
                <div class="dropdown">
                    <a href="#" class="text-decoration-none text-primary dropdown-toggle" id="dropdownProfil" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-account-circle mdi-48px text-primary"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfil">
                        <li class="dropdown-item-text"><strong>{{ session('nama') }}</strong></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="mdi mdi-logout"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-account-school mdi-36px"></i>
                    <div class="h6 mt-2">Siswa</div>
                    <div class="display-6">{{ $jumlahSiswa }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-trophy mdi-36px"></i>
                    <div class="h6 mt-2">Prestasi</div>
                    <div class="display-6">{{ $jumlahPrestasi }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-account-voice mdi-36px"></i>
                    <div class="h6 mt-2">Konseling</div>
                    <div class="display-6">{{ $jumlahKonseling }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-calendar-check mdi-36px"></i>
                    <div class="h6 mt-2">Absensi</div>
                    <div class="display-6">{{ $jumlahAbsensi }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">Aktivitas Terbaru</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @forelse($aktivitas as $item)
                            <li class="mb-3 d-flex align-items-start">
                                {!! $item !!}
                            </li>
                        @empty
                            <li class="text-muted">Belum ada aktivitas terbaru.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
