@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">

    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info d-flex justify-content-between align-items-center shadow-sm">
                <div>
                    <h5 class="mb-1">Selamat Datang, {{ session('nama') ?? 'Admin' }}!</h5>
                    <p class="mb-0">Anda login sebagai Administrator. Berikut ringkasan sistem.</p>
                </div>
                <div class="dropdown">
                    <a href="#" class="text-decoration-none text-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="mdi mdi-account-circle mdi-48px text-primary"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item-text"><strong>{{ session('nama') }}</strong></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">@csrf
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

    <div class="row">
        @php $colors = ['primary', 'success', 'warning', 'danger'];
              $labels = ['Siswa', 'Guru', 'Kelas', 'Prestasi'];
              $values = [$jumlahSiswa, $jumlahGuru, $jumlahKelas, $jumlahPrestasi];
              $icons = ['school', 'account-tie', 'google-classroom', 'star-circle'];
        @endphp
        @foreach($values as $i => $val)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white bg-{{ $colors[$i] }} shadow-sm">
                <div class="card-body text-center py-4">
                    <i class="mdi mdi-{{ $icons[$i] }} mdi-36px"></i>
                    <div class="h6 mt-2">{{ $labels[$i] }}</div>
                    <div class="display-6 count-up" data-count="{{ $val }}">0</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">Grafik Statistik</div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">Diagram Pie</div>
                <div class="card-body">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-semibold">Aktivitas Terbaru</div>
                <div class="card-body">
                    <ul class="timeline list-unstyled mb-0">
                        @forelse($aktivitas as $item)
                        <li class="mb-3 d-flex align-items-start">
                            <i class="mdi {{ $item['icon'] }} mdi-24px me-2"></i>
                            <div>{!! $item['text'] !!}<br><small class="text-muted">{{ $item['date'] }}</small></div>
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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.querySelectorAll('.count-up').forEach(el => {
        const target = +el.dataset.count;
        let count = 0;
        const step = Math.ceil(target / 50);
        const interval = setInterval(() => {
            count += step;
            el.textContent = count > target ? target : count;
            if (count >= target) clearInterval(interval);
        }, 20);
    });

    const labels = ['Siswa', 'Guru', 'Kelas', 'Prestasi'];
    const data = [{{ $jumlahSiswa }}, {{ $jumlahGuru }}, {{ $jumlahKelas }}, {{ $jumlahPrestasi }}];
    const colors = ['#0d6efd', '#198754', '#ffc107', '#dc3545'];

    new Chart(document.getElementById('barChart'), {
        type: 'bar', data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah',
                data: data,
                backgroundColor: colors,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.label}: ${ctx.parsed} data`
                    }
                }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: colors
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // supaya tinggi bisa diatur manual
        plugins: {
            legend: { position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: ctx => `${ctx.label}: ${ctx.parsed} data`
                }
            }
        }
    }
});

</script>
@endsection
