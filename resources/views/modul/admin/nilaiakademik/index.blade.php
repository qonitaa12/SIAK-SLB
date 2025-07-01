@extends('layouts.app')

@section('content')
<div class="row flex-grow">
  <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <div class="container-fluid">
          <h2>Data Nilai Akademik</h2>

          <!-- Tombol Tambah Data -->
          <div class="text-end mb-3">
            <button class="btn btn-primary text-white" id="btnTambah">
              <i class="mdi mdi-plus"></i> Tambah Data
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalTambahNilaiAkademik" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Form Nilai Akademik</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContent"></div>
              </div>
            </div>
          </div>

          <!-- Tabel -->
          <div class="table-responsive">
            <table class="table table-hover nowrap" id="nilai-akademik-table" style="width:100%">
              <thead>
                <tr>
                  <th>Semester</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Mapel</th>
                  <th>Formatif</th>
                  <th>Sumatif CP</th>
                  <th>Sumatif Semester</th>
                  <th>Tingkat Akhir</th>
                  <th>Evaluasi</th>
                  <th>Total</th>
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

<!-- Tambahan CSS untuk nowrap -->
<style>
  table.dataTable td {
    white-space: nowrap;
  }
</style>

<script>
  $(document).ready(function () {
    $('#nilai-akademik-table').DataTable({
      processing: true,
      scrollX: true,
      responsive: true,
      ajax: '{{ route('nilai_akademik.data') }}',
      columns: [
        { data: 'semester', name: 'semester' },
        { data: 'siswa', name: 'siswa' },
        { data: 'kelas', name: 'kelas' },
        { data: 'mapel', name: 'mapel' },
        { data: 'rata_formatif', name: 'rata_formatif' },
        {
          data: 'rata_sumatif_cp',
          name: 'rata_sumatif_cp',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: 'rata_sumatif_semester',
          name: 'rata_sumatif_semester',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: 'rata_tingkat_akhir',
          name: 'rata_tingkat_akhir',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: 'evaluasi',
          name: 'evaluasi',
          render: function (data) {
            return data ?? '-';
          }
        },
        {
          data: null,
          name: 'total',
          render: function (data, type, row) {
            let f = parseFloat(row.rata_formatif || 0);
            let s_cp = parseFloat(row.rata_sumatif_cp || 0);
            let s_sem = parseFloat(row.rata_sumatif_semester || 0);
            let t = parseFloat(row.rata_tingkat_akhir || 0);
            let total = (f + s_cp + s_sem + t) / 4;
            return total.toFixed(2);
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

    // Tambah Data
    $('#btnTambah').click(function () {
      $.get("{{ route('nilai_akademik.create') }}", function (data) {
        $('#modalContent').html(data);
        $('#modalTambahNilaiAkademik').modal('show');

        $('#modalTambahNilaiAkademik').on('shown.bs.modal', function () {
          $('.select2').select2({ dropdownParent: $('#modalTambahNilaiAkademik') });
        });
      });
    });

    // Edit Data
    $(document).on('click', '.btn-edit', function () {
      var id = $(this).data('id');
      $.get(`/nilai_akademik/${id}/edit`, function (data) {
        $('#modalContent').html(data);
        $('#modalTambahNilaiAkademik').modal('show');

        $('#modalTambahNilaiAkademik').on('shown.bs.modal', function () {
          $('.select2').select2({ dropdownParent: $('#modalTambahNilaiAkademik') });
        });
      });
    });

    // Hapus Data
    $(document).on('click', '.btn-delete', function () {
      var id = $(this).data('id');
      if (confirm('Yakin ingin menghapus data nilai ini?')) {
        $.ajax({
          url: `/nilai_akademik/${id}/delete`,
          type: 'POST',
          data: { _token: '{{ csrf_token() }}' },
          success: function (response) {
            $('#nilai-akademik-table').DataTable().ajax.reload();
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
