@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Jadwal Pertemuan</h2>

          <!-- Tombol Tambah Data -->
          <div class="text-end mb-3">
            <button class="btn btn-primary text-white" id="btnTambah">
              <i class="mdi mdi-plus"></i> Tambah Data
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalTambahJadwalpertemuan" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Data Jadwal Pertemuan</h5>
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
            <table class="table table-hover" id="jadwal_pertemuan-table" style="width:100%">
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
    // Inisialisasi DataTable
    $('#jadwal_pertemuan-table').DataTable({
      processing: true,
      // serverSide: true,
      ajax: '{{ route('guru.jadwal_pertemuan.data') }}',
      columns: [
      { data: 'tanggal', name: 'tanggal' },
      { data: 'waktu', name: 'waktu' },
      { data: 'tempat', name: 'tempat' },
      { data: 'nama_ayah', name: 'nama_ayah' },
      { data: 'nama_ibu', name: 'nama_ibu' },
      { data: 'nama_wali', name: 'nama_wali' },
      { data: 'nama_guru', name: 'nama_guru' },
      { data: 'status', name: 'status' },
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

    // Tambah Data
    $('#btnTambah').click(function () {
      $.get("{{ route('guru.jadwal_pertemuan.create') }}", function (data) {
        $('#modalContent').html(data);
        $('#modalTambahJadwalpertemuan').modal('show');

        // Inisialisasi Select2 setelah modal tampil
        $('#modalTambahJadwalpertemuan').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahJadwalpertemuan')
          });
        });
      });
    });

    // Edit Data
    $(document).on('click', '.btn-edit', function () {
      var id = $(this).data('id');
      $.get(`/jadwal_pertemuan/${id}/edit`, function (data) {
        $('#modalContent').html(data);
        $('#modalTambahJadwalpertemuan').modal('show');

        // Inisialisasi Select2
        $('#modalTambahJadwalpertemuan').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahJadwalpertemuan')
          });
        });
      });
    });

    // Hapus Data
    $(document).on('click', '.btn-delete', function () {
      var id = $(this).data('id');

      if (confirm('Yakin ingin menghapus data jadwal pertemuan ini?')) {
        $.ajax({
          url: `/jadwal_pertemuan/${id}/delete`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function (response) {
            $('#jadwal_pertemuan-table').DataTable().ajax.reload();
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
