@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Jadwal Pelajaran</h2>

          <!-- Tombol Tambah Data -->
          <div class="text-end mb-3">
            <button class="btn btn-primary text-white" id="btnTambah">
              <i class="mdi mdi-plus"></i> Tambah Data
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalTambahJadwalpelajaran" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Data Jadwal Pelajaran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContent">
                  <!-- AJAX content will be loaded here -->
                </div>
              </div>
            </div>
          </div>

          <!-- Tabel -->
          <div class="table-responsive">
            <table class="table table-hover" id="jadwal_pelajaran-table" style="width:100%">
              <thead>
                <tr>
                  <th>Hari</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Kelas</th>
                  <th>Nama Mata Pelajaran</th>
                  <th>Nama Guru</th>
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
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function () {
    $('#jadwal_pelajaran-table').DataTable({
      processing: true,
      // serverSide: true,
      ajax: '{{ route('jadwal_pelajaran.data') }}',
      columns: [
        { data: 'hari', name: 'hari'},
        { data: 'jam_mulai', name: 'jam_mulai'},
        { data: 'jam_selesai', name: 'jam_selesai' },
        { data: 'kelas', name: 'kelas' },
        { data: 'nama_mapel', name: 'nama_mapel' },
        { data: 'nama', name: 'nama'},
        {
          data: null,
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-warning btn-edit" data-id="${row.id}">
                <i class="mdi mdi-pencil"></i>
              </button>
              <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}">
                <i class="mdi mdi-delete"></i>
              </button>
            `;
          }
        }
      ]
    });

    $('#btnTambah').click(function () {
      $.get("{{ route('jadwal_pelajaran.create') }}", function (data) {
        $('#modalContent').html(data);
        $('#modalTambahJadwalpelajaran').modal('show');

        // Inisialisasi Select2 setelah modal ditampilkan
        $('#modalTambahJadwalpelajaran').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahJadwalpelajaran')
          });
        });
      });
    });

    $(document).on('click', '.btn-edit', function () {
      var id = $(this).data('id');
      $.get(`/jadwal_pelajaran/${id}/edit`, function (data) {
        $('#modalContent').html(data);
        $('#modalTambahJadwalpelajaran').modal('show');

        // Inisialisasi Select2 saat modal edit muncul
        $('#modalTambahJadwalpelajaran').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahJadwalpelajaran')
          });
        });
      });
    });

    $(document).on('click', '.btn-delete', function () {
      var id = $(this).data('id');

      if (confirm('Yakin ingin menghapus data jadwal pelajaran ini?')) {
        $.ajax({
          url: `/jadwal_pelajaran/${id}/delete`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function (response) {
            $('#jadwal_pelajaran-table').DataTable().ajax.reload();
            alert(response.message);
          },
          error: function () {
            alert('Gagal menghapus data.');
          }
        });
      }
    });
  });
</script>
@endsection
