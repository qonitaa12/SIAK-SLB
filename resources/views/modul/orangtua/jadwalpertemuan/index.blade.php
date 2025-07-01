@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Jadwal Pertemuan</h2>

          <!-- Tabel -->
          <div class="table-responsive mt-4">
            <table class="table" id="jadwal_pertemuan-table" style="width:100%">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Waktu</th>
                  <th>Tempat</th>
                  <th>Nama Ayah</th>
                  <th>Nama Ibu</th>
                  <th>Nama Wali</th>
                  <th>Nama Guru</th>
                  <th>Status</th>
                </tr>
              </thead>
            </table>
          </div>
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

<!-- CSS tambahan untuk jarak antar baris -->
<style>
  #jadwal_pertemuan-table tbody tr td {
    padding-top: 12px;
    padding-bottom: 12px;
    vertical-align: middle;
  }

  #jadwal_pertemuan-table thead th {
    vertical-align: middle;
  }
</style>

<script>
  $(document).ready(function () {
    $('#jadwal_pertemuan-table').DataTable({
      ajax: '{{ route('orangtua.jadwal_pertemuan.data') }}',
      columns: [
        { data: 'tanggal', name: 'tanggal' },
        { data: 'waktu', name: 'waktu' },
        { data: 'tempat', name: 'tempat' },
        { data: 'nama_ayah', name: 'nama_ayah' },
        { data: 'nama_ibu', name: 'nama_ibu' },
        { data: 'nama_wali', name: 'nama_wali' },
        { data: 'nama_guru', name: 'nama_guru' },
        { data: 'status', name: 'status' },
      ]
    });
  });
</script>
@endsection
