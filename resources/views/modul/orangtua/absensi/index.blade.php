@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <!-- Card Judul -->
  <div class="col-12 mb-3">
    <div class="card shadow-sm border-0 custom-header-card text-white">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <h4 class="mb-0 fw-bold">📅 Data Absensi</h4>
          <small class="text-white">Lihat riwayat kehadiran siswa beserta dokumentasinya.</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Tabel -->
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded shadow-sm border-0">
      <div class="card-body">
        <div class="container-fluid">

          <!-- Modal -->
          <div class="modal fade" id="modalDetailAbsensi" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detail Absensi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContent"></div>
              </div>
            </div>
          </div>

          <!-- Tabel -->
          <div class="table-responsive">
            <table class="table table-hover" id="absensi-table" style="width:100%">
              <thead class="table-light text-center">
                <tr>
                  <th>Tanggal</th>
                  <th>Nama Kelas</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                  <th>Dokumentasi</th>
                  <th>Aksi</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
  table.dataTable td {
    white-space: nowrap;
  }

  .custom-header-card {
    background-color: rgb(89, 115, 181); /* Biru lembut */
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
    $('#absensi-table').DataTable({
      processing: true,
      ajax: '{{ route('absensi_orangtua.data') }}',
      columns: [
        { data: 'tanggal' },
        { data: 'nama_kelas' },
        { data: 'status_kehadiran' },
        { data: 'keterangan' },
        {
          data: 'dokumentasi',
          render: data => data ? `<a href="/storage/${data}" target="_blank">Lihat</a>` : '-'
        },
        {
          data: null,
          render: data => `<button class="btn btn-sm btn-info btn-detail" data-id="${data.id}"><i class="mdi mdi-eye"></i></button>`
        }
      ]
    });

    // Tampilkan detail absensi
    $(document).on('click', '.btn-detail', function () {
      var id = $(this).data('id');
      $.get(`/absensi_orangtua/${id}`, function (data) {
        $('#modalContent').html(data);
        $('#modalDetailAbsensi').modal('show');
      });
    });
  });
</script>
@endsection
