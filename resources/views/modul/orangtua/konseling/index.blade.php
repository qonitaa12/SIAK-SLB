@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded shadow-sm">
      <div class="card-body">
        <h4 class="card-title mb-4">Data Konseling Siswa</h4>

        <div class="table-responsive">
          <table class="table table-hover" id="konseling-table" style="width:100%">
            <thead>
              <tr>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Tanggal</th>
                <th>Kesehatan</th>
                <th>Catatan</th>
                <th>Nama Guru</th>
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
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
  #konseling-table_wrapper {
    animation: fadeIn 0.4s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Hover baris */
  #konseling-table tbody tr:hover {
    background-color: #f8f9fa !important;
  }

  /* Fokus search */
  .dataTables_filter input:focus {
    border-color: #999 !important;
    box-shadow: 0 0 5px #999 !important;
  }

  /* Pagination aktif */
  .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #6c757d !important;
    color: #fff !important;
    border: none !important;
  }

  /* Jarak antar data */
  #konseling-table tbody td {
    padding-top: 12px;
    padding-bottom: 12px;
    vertical-align: middle;
  }

  /* Custom badge abu-abu */
  .badge-gray {
    background-color: #adb5bd;
    color: white;
    padding: 4px 8px;
    border-radius: 0.25rem;
    font-size: 0.75rem;
  }

  .badge-success { background-color: #28a745; }
  .badge-danger { background-color: #dc3545; }
</style>

<script>
  $(document).ready(function () {
    $('#konseling-table').DataTable({
      processing: true,
      // serverSide: true,
      searching: true, // Pastikan search aktif
      ajax: '{{ route('orangtua.konseling.data') }}',
      columns: [
        { data: 'nama_siswa', name: 'nama_siswa' },
        { data: 'nisn', name: 'nisn' },
        { data: 'tanggal', name: 'tanggal' },
        {
          data: 'kesehatan',
          name: 'kesehatan',
          render: function (data) {
            let badgeClass = 'badge-gray';
            if (data.toLowerCase().includes('sehat')) badgeClass = 'badge-success';
            else if (data.toLowerCase().includes('sakit')) badgeClass = 'badge-danger';
            return `<span class="badge ${badgeClass}">${data}</span>`;
          }
        },
        { data: 'catatan', name: 'catatan' },
        { data: 'nama', name: 'nama' }
      ]
    });
  });
</script>
@endsection
