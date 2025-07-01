@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Guru Mata Pelajaran</h2>

          <!-- Tombol Tambah Data -->
          <div class="text-end mb-3">
            <button class="btn btn-primary text-white" id="btnTambah">
              <i class="mdi mdi-plus"></i> Tambah Data
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalTambahGurumapel" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Data Guru Mata Pelajaran</h5>
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
            <table class="table table-hover" id="guru_mapel-table" style="width:100%">
              <thead>
                <tr>
                  <th>Tahun Ajaran</th>
                  <th>Semester</th>
                  <th>Nama Guru</th>
                  <th>Mata Pelajaran</th>
                  <th>Nama Kelas</th>
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
    $('#guru_mapel-table').DataTable({
      processing: true,
      // serverSide: true,
      ajax: '{{ route('guru_mapel.data') }}',
      columns: [
        { data: 'tahun_ajaran', name: 'tahun_ajaran' },
        { data: 'semester', name: 'semester' },
        { data: 'nama', name: 'nama' },
        { data: 'nama_mapel', name: 'nama_mapel' }, // akan diubah di controller
        { data: 'nama_kelas', name: 'nama_kelas' },
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
      $.get("{{ route('guru_mapel.create') }}", function (data) {
        $('#modalContent').html(data);
        $('#modalTambahGurumapel').modal('show');

        // Inisialisasi Select2 setelah modal ditampilkan
        $('#modalTambahGurumapel').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahGurumapel')
          });
        });
      });
    });

    $(document).on('click', '.btn-edit', function () {
      var id = $(this).data('id');
      $.get(`/guru_mapel/${id}/edit`, function (data) {
        $('#modalContent').html(data);
        $('#modalTambahGurumapel').modal('show');

        // Inisialisasi Select2 saat modal edit muncul
        $('#modalTambahGurumapel').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahGurumapel')
          });
        });
      });
    });

    $(document).on('click', '.btn-delete', function () {
      var id = $(this).data('id');

      if (confirm('Yakin ingin menghapus data guru mapel ini?')) {
        $.ajax({
          url: `/guru_mapel/${id}/delete`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function (response) {
            $('#guru_mapel-table').DataTable().ajax.reload();
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
