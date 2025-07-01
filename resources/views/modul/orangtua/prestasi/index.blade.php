@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Prestasi Siswa</h2>

  <!-- Search -->
  <div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama siswa atau lomba...">
  </div>

  <!-- Kontainer Kartu -->
  <div class="row" id="prestasiContainer">
    @forelse($prestasi as $item)
      <div class="col-md-6 col-lg-4 mb-4 prestasi-item">
        <div class="card shadow-sm h-100">
          @if($item->dokumentasi)
            <img src="{{ asset($item->dokumentasi) }}" class="card-img-top" alt="Dokumentasi Prestasi" style="height: 200px; object-fit: cover;">
          @else
            <div style="height: 200px; background: #ddd; display: flex; align-items: center; justify-content: center;">
              <span class="text-muted">Tidak ada foto</span>
            </div>
          @endif

          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $item->lomba }}</h5>
            <p class="card-text mb-1"><strong>Nama Siswa:</strong> <span class="nama">{{ $item->nama }}</span></p>
            <p class="card-text mb-1"><strong>Tingkat:</strong> {{ $item->tingkat }}</p>
            <p class="card-text mb-1"><strong>Juara:</strong> {{ $item->juara }}</p>
            <p class="card-text text-muted mt-auto"><small>Tanggal: {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small></p>
          </div>
        </div>
      </div>
    @empty
      <p>Tidak ada data prestasi.</p>
    @endforelse
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    <button id="prevBtn" class="btn btn-outline-primary me-2">Previous</button>
    <button id="nextBtn" class="btn btn-outline-primary">Next</button>
  </div>
</div>
@endsection

@section('js')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 6;
    let currentPage = 1;

    const items = document.querySelectorAll(".prestasi-item");
    const totalItems = items.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    const searchInput = document.getElementById("searchInput");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    function showPage(page) {
      let start = (page - 1) * itemsPerPage;
      let end = page * itemsPerPage;

      items.forEach((item, index) => {
        item.style.display = index >= start && index < end ? "block" : "none";
      });

      prevBtn.disabled = page === 1;
      nextBtn.disabled = page === totalPages;
    }

    prevBtn.addEventListener("click", function () {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    });

    nextBtn.addEventListener("click", function () {
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
      }
    });

    searchInput.addEventListener("keyup", function () {
      const query = this.value.toLowerCase();

      items.forEach(item => {
        const nama = item.querySelector(".nama").textContent.toLowerCase();
        const lomba = item.querySelector(".card-title").textContent.toLowerCase();

        if (nama.includes(query) || lomba.includes(query)) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      });

      // Sembunyikan tombol pagination saat pencarian aktif
      const anyVisible = [...items].some(item => item.style.display === "block");
      document.querySelector(".d-flex.mt-4")?.style.setProperty("display", anyVisible ? "flex" : "none");
    });

    // Tampilkan halaman pertama saat load
    showPage(currentPage);
  });
</script>
@endsection
