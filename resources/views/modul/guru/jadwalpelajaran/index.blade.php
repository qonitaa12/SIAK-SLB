@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Jadwal Pelajaran</h2>

          <!-- Container jadwal per kelas -->
          <div id="jadwal-container" class="mt-3">
            <!-- Isi jadwal akan di-render via JS -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
  .kelas-section {
    margin-bottom: 40px;
  }
  .kelas-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 10px;
    border-bottom: 3px solid #13236b;
    padding: 10px;
    color: #13236b;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f7f9fc;
    border-radius: 8px;
    transition: background-color 0.3s ease;
  }
  .kelas-title:hover {
    background-color: #e4eaf7;
  }
  .toggle-icon {
    font-size: 1.4rem;
    font-weight: bold;
  }
  .hari-section {
    margin-bottom: 30px;
  }
  .hari-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #444;
  }
  .jadwal-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    background-color: #fff;
    margin-bottom: 12px;
    transition: box-shadow 0.3s ease;
    flex: 1 1 250px;
    max-width: 300px;
  }
  .jadwal-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }
  .jadwal-mapel {
    font-weight: 700;
    font-size: 1.1rem;
    color: #13236b;
  }
  .jadwal-info {
    font-size: 0.9rem;
    color: #555;
    margin-top: 6px;
  }
  .jadwal-guru {
    margin-top: 8px;
    font-style: italic;
    color: #666;
  }
  .jadwal-list {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
  }
</style>

<script>
  $(document).ready(function () {
    function loadJadwal() {
      $.ajax({
        url: '{{ route("jadwal_pelajaran.data") }}',
        type: 'GET',
        success: function(response) {
          renderJadwal(response.data);
        },
        error: function() {
          $('#jadwal-container').html('<p class="text-danger">Gagal memuat data jadwal.</p>');
        }
      });
    }

    function renderJadwal(data) {
      if(!data || data.length === 0) {
        $('#jadwal-container').html('<p>Tidak ada data jadwal pelajaran.</p>');
        return;
      }

      const groupedByKelas = {};
      data.forEach(item => {
        if(!groupedByKelas[item.kelas]) {
          groupedByKelas[item.kelas] = [];
        }
        groupedByKelas[item.kelas].push(item);
      });

      let html = '';

      Object.keys(groupedByKelas).sort().forEach((kelas, index) => {
        const kelasId = `kelas-${index}`;
        html += `
          <div class="kelas-section">
            <div class="kelas-title" data-toggle="${kelasId}">
              <span>Kelas: ${kelas}</span>
              <span class="toggle-icon" id="icon-${kelasId}">+</span>
            </div>
            <div class="kelas-content mt-3" id="${kelasId}" style="display: none;">
        `;

        const byHari = {};
        groupedByKelas[kelas].forEach(jadwal => {
          if(!byHari[jadwal.hari]) byHari[jadwal.hari] = [];
          byHari[jadwal.hari].push(jadwal);
        });

        const urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        urutanHari.forEach(hari => {
          if(byHari[hari]) {
            html += `<div class="hari-section">
                       <div class="hari-title">${hari}</div>
                       <div class="jadwal-list">`;
            byHari[hari].forEach(jadwal => {
              html += `
                <div class="jadwal-card">
                  <div class="jadwal-mapel">${jadwal.nama_mapel}</div>
                  <div class="jadwal-info">Jam: ${jadwal.jam_mulai} - ${jadwal.jam_selesai}</div>
                  <div class="jadwal-guru">Guru: ${jadwal.nama}</div>
                </div>
              `;
            });
            html += `</div></div>`;
          }
        });

        html += `</div></div>`;
      });

      $('#jadwal-container').html(html);

      // Expand/collapse toggle
      $('.kelas-title').on('click', function() {
        const targetId = $(this).data('toggle');
        $(`#${targetId}`).slideToggle();

        const icon = $(`#icon-${targetId}`);
        icon.text(icon.text() === '+' ? '−' : '+');
      });
    }

    loadJadwal();
  });
</script>
@endsection
