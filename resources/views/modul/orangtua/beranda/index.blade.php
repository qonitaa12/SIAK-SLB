@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <!-- Welcome -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-primary d-flex justify-content-between align-items-center shadow-sm">
                <div>
                    <h5 class="mb-1">Halo, Orang Tua dari {{ session('nama') ?? 'Anak Anda' }}!</h5>
                    <p class="mb-0">Berikut adalah ringkasan perkembangan dan kegiatan anak Anda.</p>
                </div>
                <div class="dropdown">
                    <a href="#" class="text-decoration-none text-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="mdi mdi-account-circle mdi-48px text-primary"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
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

    <!-- Statistik Utama -->
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-trophy mdi-36px"></i>
                    <div class="h6 mt-2">Prestasi</div>
                    <div class="display-6">{{ $jumlahPrestasi }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-account-voice mdi-36px"></i>
                    <div class="h6 mt-2">Konseling</div>
                    <div class="display-6">{{ $jumlahKonseling }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-calendar-check mdi-36px"></i>
                    <div class="h6 mt-2">Hadir</div>
                    <div class="display-6">{{ $jumlahAbsensi }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pertemuan Terdekat -->
    @if($pertemuanTerdekat)
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card border-start border-3 border-primary shadow-sm">
                <div class="card-header bg-light fw-semibold">
                    <i class="mdi mdi-calendar-clock text-primary me-2"></i> Jadwal Pertemuan Terdekat
                </div>
                <div class="card-body">
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pertemuanTerdekat->tanggal)->translatedFormat('d F Y') }}</p>
                    <p><strong>Waktu:</strong> {{ $pertemuanTerdekat->waktu }}</p>
                    <p><strong>Tempat:</strong> {{ $pertemuanTerdekat->tempat }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $pertemuanTerdekat->status == 'Disetujui' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $pertemuanTerdekat->status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Aktivitas Terbaru -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">Aktivitas Terbaru Anak</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @forelse($aktivitas as $item)
                            <li class="mb-3 d-flex align-items-start">
                                {!! $item !!}
                            </li>
                        @empty
                            <li class="text-muted">Belum ada aktivitas terbaru yang dicatat.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Lainnya -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">
                    <i class="mdi mdi-clipboard-text text-primary me-2"></i> Nilai Akademik
                </div>
                <div class="card-body">
                    <p>Jumlah nilai yang tersedia: <strong>{{ $jumlahNilai }}</strong></p>
                    <p>Lihat detail nilai di menu <a href="#" class="text-decoration-underline">Nilai Akademik</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">
                    <i class="mdi mdi-book-clock text-dark me-2"></i> Jadwal Pelajaran
                </div>
                <div class="card-body">
                    <p>Total jadwal pelajaran: <strong>{{ $jumlahJadwal }}</strong></p>
                    <p>Silakan cek jadwal di halaman <a href="#" class="text-decoration-underline">Jadwal Pelajaran</a>.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
