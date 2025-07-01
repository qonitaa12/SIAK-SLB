@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Prestasi</h2>

          <!-- Tombol Tambah Data -->
          <div class="text-end mb-3">
            <button class="btn btn-primary text-white" id="btnTambah">
              <i class="mdi mdi-plus"></i> Tambah Data
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalTambahPrestasi" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Data Prestasi</h5>
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
            <table class="table table-hover" id="prestasi-table" style="width:100%">
              <thead>
                <tr>
                  <th>Nama Siswa</th>
                  <th>NISN</th>
                  <th>Lomba</th>
                  <th>Tingkat</th>
                  <th>Juara</th>
                  <th>Tanggal</th>
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
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function () {
    $('#prestasi-table').DataTable({
  processing: true,
  // serverSide: true,
  ajax: '{{ route('guru.prestasi.data') }}',
  columns: [
    { data: 'nama', name: 'nama' },
    { data: 'nisn', name: 'nisn' },
    { data: 'lomba', name: 'lomba' },
    { data: 'tingkat', name: 'tingkat' },
    { data: 'juara', name: 'juara' },
    { data: 'tanggal', name: 'tanggal' },
    {
    data: 'dokumentasi',
    name: 'dokumentasi',
    render: function (data, type, row) {
    // Gunakan teks rapi
    return `<a href="/${data}" target="_blank" style="text-decoration: underline; color: #007bff;">Lihat Dokumentasi</a>`;
  }
},
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
      $.get("{{ route('guru.prestasi.create') }}", function (data) {
        $('#modalContent').html(data);
        $('#modalTambahPrestasi').modal('show');

        // Inisialisasi Select2 setelah modal ditampilkan
        $('#modalTambahPrestasi').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahPrestasi')
          });
        });
      });
    });

    $(document).on('click', '.btn-edit', function () {
      var id = $(this).data('id');
      $.get(`/prestasi/${id}/edit`, function (data) {
        $('#modalContent').html(data);
        $('#modalTambahPrestasi').modal('show');

        // Inisialisasi Select2 saat modal edit muncul
        $('#modalTambahPrestasi').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahPrestasi')
          });
        });
      });
    });

    $(document).on('click', '.btn-delete', function () {
      var id = $(this).data('id');

      if (confirm('Yakin ingin menghapus data prestasi ini?')) {
        $.ajax({
          url: `/prestasi/${id}/delete`,
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function (response) {
            $('#prestasi-table').DataTable().ajax.reload();
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
