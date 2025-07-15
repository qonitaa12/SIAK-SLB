@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <!-- Card Judul -->
  <div class="col-12 mb-3">
    <div class="card shadow-sm border-0 custom-header-card text-white">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <h4 class="mb-0 fw-bold">📚 Data Nilai Akademik</h4>
          <small class="text-white">Pantau perkembangan nilai siswa berdasarkan mata pelajaran dan semester.</small>
        </div>
      </div>
    </div>
  </div>


  <!-- Card Tabel -->
  <div class="col-12">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped nowrap" id="nilai-akademik-table" style="width:100%">
            <thead class="table-light text-center">
              <tr>
                <th>Semester</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mapel</th>
                <th>Formatif</th>
                <th>Sumatif CP</th>
                <th>Sumatif Semester</th>
                <th>Tingkat Akhir</th>
                <th>Evaluasi</th>
                <th>Total</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<!-- DataTables Assets -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Optional: Styling -->
<style>
  table.dataTable td {
    white-space: nowrap;
  }

  .card h4 {
    font-size: 1.25rem;
  }

  .text-white-50 {
    color: rgba(255, 255, 255, 0.75);
  }

    .custom-header-card {
    background-color: rgb(89, 115, 181); /* Warna biru lembut */
  }

  .custom-header-card .card-body {
    padding: 1.25rem 1.5rem;
  }

  .custom-header-card h4 {
    font-size: 1.25rem;
  }
</style>

<script>
  $(document).ready(function () {
    $('#nilai-akademik-table').DataTable({
      processing: true,
      scrollX: true,
      responsive: true,
      ajax: '{{ route('orangtua.nilai_akademik.data') }}',
      columns: [
        { data: 'semester', name: 'semester' },
        { data: 'siswa', name: 'siswa' },
        { data: 'kelas', name: 'kelas' },
        { data: 'mapel', name: 'mapel' },
        { data: 'rata_formatif', name: 'rata_formatif' },
        {
          data: 'rata_sumatif_cp',
          name: 'rata_sumatif_cp',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: 'rata_sumatif_semester',
          name: 'rata_sumatif_semester',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: 'rata_tingkat_akhir',
          name: 'rata_tingkat_akhir',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: 'evaluasi',
          name: 'evaluasi',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: null,
          name: 'total',
          render: function (data, type, row) {
            let f = parseFloat(row.rata_formatif || 0);
            let s_cp = parseFloat(row.rata_sumatif_cp || 0);
            let s_sem = parseFloat(row.rata_sumatif_semester || 0);
            let t = parseFloat(row.rata_tingkat_akhir || 0);
            let total = (f + s_cp + s_sem + t) / 4;
            return total.toFixed(2);
          }
        }
      ]
    });
  });
</script>
@endsection
