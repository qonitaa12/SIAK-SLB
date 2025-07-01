@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
      <div class="container-fluid">
          <div>
      <h2>Data Guru</h2>
      <!-- {{-- Tombol Tambah Data --}} -->
      <div class="text-end mb-3">
    <button class="btn btn-primary text-white" id="btnTambah">
      <i class="mdi mdi-plus"></i> Tambah Data
    </button>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalTambahGuru" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Guru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="modalContent">
          <!-- AJAX content will be loaded here -->
        </div>
      </div>
    </div>
  </div>

      <!-- {{-- Tabel --}} -->
      <div class="table-responsive">
      <table class="table table-hover" id="guru-table" style="width:100%">
          <thead>
            <tr>
              <!-- {{-- <th>ID</th> disembunyikan via JS --}} -->
              <th>Nip</th>
              <th>Nama</th>
              <th>Bidang Ajar</th>
              <th>Jabatan</th>
              <th>Kontak</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('js')
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/hoverable-collapse.js"></script>
<script>
  $(document).ready(function () {
        $('#guru-table').DataTable({
        processing: true,
        ajax: '{{ route('guru.data') }}',
        columns: [
          { data: 'nip', name: 'nip' },
          { data: 'nama', name: 'nama' },
          { data: 'bidang_ajar', name: 'bidang_ajar' },
          { data: 'jabatan', name: 'jabatan' },
          { data: 'kontak', name: 'kontak' },
          {
            data: null,
            name: 'action',
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
  });

  $('#btnTambah').click(function () {
    $.get("{{ route('guru.create') }}", function(data) {
      $('#modalContent').html(data);
      $('#modalTambahGuru').modal('show');
    });
  });

  $(document).on('click', '.btn-edit', function () {
  var id = $(this).data('id');

  $.get(`/guru/${id}/edit`, function (data) {
    $('#modalContent').html(data);
    $('#modalTambahGuru').modal('show');
  });
});

$(document).on('click', '.btn-delete', function () {
  var id = $(this).data('id');

  if (confirm('Yakin ingin menghapus data guru ini?')) {
    $.ajax({
      url: `/guru/${id}/delete`,
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function (response) {
        $('#guru-table').DataTable().ajax.reload();
        alert(response.message);
      },
      error: function () {
        alert('Gagal menghapus data.');
      }
    });
  }
});


</script>
@endsection
