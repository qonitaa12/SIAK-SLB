@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <div>
            <h2>Data Siswa</h2>

            <!-- Tombol Tambah Data -->
            {{-- Uncomment jika fitur tambah digunakan --}}
            {{-- 
            <div class="text-end mb-3">
              <button class="btn btn-primary text-white" id="btnTambah">
                <i class="mdi mdi-plus"></i> Tambah Data
              </button>
            </div>
            --}}

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
              <table class="table table-hover" id="siswa-table" style="width:100%">
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
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/hoverable-collapse.js"></script>

<script>
  $(document).ready(function () {
    $('#siswa-table').DataTable({
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

  // Tampilkan detail siswa
  $(document).on('click', '.btn-detail', function () {
    var id = $(this).data('id');

    $.get(`/siswa_guru/${id}`, function (data) {
      $('#modalContent').html(data);
      $('#modalTambahSiswa').modal('show');
    });
  });


</script>
@endsection
