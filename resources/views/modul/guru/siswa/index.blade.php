@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Siswa</h2>

          <!-- Modal -->
          <div class="modal fade" id="modalTambahSiswa" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Detail Data Siswa</h5>
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
            <table class="table table-hover nowrap" id="siswa-table" style="width:100%">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>NISN</th>
                  <th>Jenis Kelamin</th>
                  <th>Kebutuhan Khusus</th>
                  <th>Alamat</th>
                  <th>Agama</th>
                  <th>Anak Ke-</th>
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
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<!-- Tambahan CSS -->
<style>
  #siswa-table td {
    white-space: normal !important;
    word-wrap: break-word;
    padding: 14px 12px !important;
    line-height: 1.4em;
    vertical-align: top;
    font-size: 14px;
  }

  #siswa-table th {
    padding: 14px 12px !important;
    font-size: 14px;
    background-color: #f9f9f9;
    vertical-align: middle;
  }

  #siswa-table .btn {
    padding: 4px 8px;
    font-size: 13px;
  }

  @media (max-width: 768px) {
    h2 {
      font-size: 1.4rem;
    }

    #siswa-table {
      font-size: 13px;
    }
  }
</style>

<script>
  $(document).ready(function () {
    $('#siswa-table').DataTable({
      responsive: true,
      processing: true,
      ajax: '{{ route('guru.siswa.data') }}',
      columns: [
        { data: 'nama', name: 'nama' },
        { data: 'nisn', name: 'nisn' },
        { data: 'gender', name: 'gender' },
        { data: 'kebutuhan_khusus', name: 'kebutuhan_khusus' },
        { data: 'alamat', name: 'alamat' },
        { data: 'agama', name: 'agama' },
        { data: 'anak_ke', name: 'anak_ke' },
        {
          data: null,
          name: 'action',
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-info btn-detail" data-id="${row.id}">
                <i class="mdi mdi-eye"></i>
              </button>
            `;
          }
        }
      ]
    });
  });

  // Tombol Detail
  $(document).on('click', '.btn-detail', function () {
    var id = $(this).data('id');
    $.get(`/siswa_guru/${id}`, function (data) {
      $('#modalContent').html(data);
      $('#modalTambahSiswa').modal('show');
    });
  });
</script>
@endsection
