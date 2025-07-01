@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Absensi</h2>

          <!-- Tombol Tambah Data -->
          <div class="text-end mb-3">
            <button class="btn btn-primary text-white" id="btnTambah">
              <i class="mdi mdi-plus"></i> Tambah Data
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalTambahAbsensi" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Form Absensi</h5>
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
            <table class="table table-hover" id="absensi-table" style="width:100%">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Nama Guru</th>
                  <th>Nama Kelas</th>
                  <th>Hadir</th>
                  <th>Izin</th>
                  <th>Alfa</th>
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
    // Inisialisasi DataTables
    $('#absensi-table').DataTable({
      processing: true,
      ajax: '{{ route('absensi_admin.data') }}',
      columns: [
        { data: 'tanggal', name: 'tanggal' },
        { data: 'nama_guru', name: 'nama_guru' },
        { data: 'nama_kelas', name: 'nama_kelas' },
        { data: 'jumlah_hadir', name: 'jumlah_hadir' },
        { data: 'jumlah_izin', name: 'jumlah_izin' },
        { data: 'jumlah_alfa', name: 'jumlah_alfa' },
        {
          data: 'dokumentasi',
          name: 'dokumentasi',
          render: function (data) {
            return data
              ? `<a href="/storage/${data}" target="_blank">Lihat</a>`
              : '-';
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

   // Tambah
$('#btnTambah').click(function () {
  $.get("{{ route('absensi_admin.create') }}", function (data) {
    $('#modalContent').html(data);
    $('#modalTambahAbsensi').modal('show');

    $('#modalTambahAbsensi').on('shown.bs.modal', function () {
      $('.select2').select2({
        dropdownParent: $('#modalTambahAbsensi')
      });

      // Tambahkan script fetch siswa di sini
      $('#id_kelas').on('change', function () {
        let idKelas = $(this).val();

        if (idKelas) {
          fetch("{{ url('/admin/absensi/siswa-by-kelas') }}/" + idKelas)
            .then(res => res.json())
            .then(data => {
              let html = '';
              if (data.length > 0) {
                html += '<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Nama</th><th>Status</th><th>Keterangan</th></tr></thead><tbody>';
                data.forEach((siswa, index) => {
                  html += `
                    <tr>
                      <td>${siswa.nama}</td>
                      <td>
                        <select name="data_siswa[${siswa.id}][status]" class="form-control">
                          <option value="Hadir">Hadir</option>
                          <option value="Izin">Izin</option>
                          <option value="Tidak Hadir">Tidak Hadir</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" name="data_siswa[${siswa.id}][keterangan]" class="form-control" placeholder="Jika tidak hadir">
                      </td>
                    </tr>
                  `;

                  // Simpan id_kelas_siswa dari siswa pertama
                  if (index === 0) {
                    document.getElementById('input_id_kelas_siswa').value = siswa.id_kelas_siswa;
                  }
                });
                html += '</tbody></table></div>';
              } else {
                html = '<p class="text-muted">Tidak ada siswa dalam kelas ini.</p>';
              }

              document.getElementById('daftar-siswa').innerHTML = html;
            });
        } else {
          document.getElementById('daftar-siswa').innerHTML = '<p class="text-muted">Silakan pilih kelas terlebih dahulu untuk menampilkan siswa.</p>';
          document.getElementById('input_id_kelas_siswa').value = '';
        }
      });
    });
  });
});


    // Tombol Edit
    $(document).on('click', '.btn-edit', function () {
      var id = $(this).data('id');
      $.get(`/absensi/${id}/edit`, function (data) {
        $('#modalContent').html(data);
        $('#modalTambahAbsensi').modal('show');

        $('#modalTambahAbsensi').on('shown.bs.modal', function () {
          $('.select2').select2({
            dropdownParent: $('#modalTambahAbsensi')
          });
        });
      });
    });

    // Tombol Hapus
    $(document).on('click', '.btn-delete', function () {
      var id = $(this).data('id');
      if (confirm('Yakin ingin menghapus data absensi ini?')) {
        $.ajax({
          url: `/absensi/${id}/delete`,
          type: 'POST',
          data: { _token: '{{ csrf_token() }}' },
          success: function (response) {
            $('#absensi-table').DataTable().ajax.reload();
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
