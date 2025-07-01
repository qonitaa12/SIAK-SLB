<div class="card">
  <div class="card-body">
    <h4 class="card-title">Form Absensi</h4>

    <form action="{{ route('absensi_guru.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Yakin ingin menyimpan?')">
      @csrf

      <div class="form-group mb-3">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
      </div>

      <div class="form-group mb-3">
        <label for="id_guru">Nama Guru</label>
        <select name="id_guru" class="form-control select2" required>
          <option value="">-- Pilih Guru --</option>
          @foreach($guru as $g)
            <option value="{{ $g->id }}">{{ $g->nama }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-4">
        <label for="kelas_yang_dipilih">Pilih Kelas yang Akan Disimpan</label>
        <select name="kelas_yang_dipilih" id="kelas_yang_dipilih" class="form-control" required>
          <option value="">-- Pilih Kelas --</option>
          @foreach($daftarKelas as $kelas)
            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
          @endforeach
        </select>
      </div>

      @foreach($daftarKelas as $kelas)
  <div class="card mb-3" data-kelas-id="{{ $kelas->id }}">
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
      <strong>{{ $kelas->nama_kelas }}</strong>
      <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKelas{{ $kelas->id }}" aria-expanded="false" aria-controls="collapseKelas{{ $kelas->id }}">
        <i class="fas fa-plus"></i> Tampilkan Siswa
      </button>
    </div>

    <div class="collapse" id="collapseKelas{{ $kelas->id }}">
      <div class="card-body">
        <input type="hidden" name="id_kelas[{{ $kelas->id }}]" value="{{ $kelas->id }}">
        @if($kelas->kelasSiswa->count() > 0)
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Siswa</th>
                  <th>Status</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($kelas->kelasSiswa as $ks)
                  @php $siswa = $ks->siswa; @endphp
                  <tr>
                    <td>{{ $siswa->nama }}</td>
                    <td>
                      <select name="data_siswa[{{ $siswa->id }}][status]" class="form-control">
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Tidak Hadir">Tidak Hadir</option>
                      </select>
                    </td>
                    <td>
                      <input type="text" name="data_siswa[{{ $siswa->id }}][keterangan]" class="form-control" placeholder="Keterangan (jika ada)">
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <p class="text-muted">Tidak ada siswa di kelas ini.</p>
        @endif
      </div>
    </div>
  </div>
@endforeach


      <div class="form-group mb-3">
        <label for="dokumentasi">Dokumentasi (opsional)</label>
        <input type="file" name="dokumentasi" class="form-control" accept="image/*">
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary text-white">Simpan</button>
        <a href="{{ route('absensi_guru.index') }}" class="btn btn-light">Batal</a>
      </div>
    </form>
  </div>
</div>

@section('js')
<script>
  $(document).ready(function () {
    $('.select2').select2();

    // Collapse: Ubah ikon +/-
    $('[data-bs-toggle="collapse"]').on('click', function () {
      const icon = $(this).find('i');
      setTimeout(() => {
        if ($(this).attr('aria-expanded') === 'true') {
          icon.removeClass('fa-plus').addClass('fa-minus');
        } else {
          icon.removeClass('fa-minus').addClass('fa-plus');
        }
      }, 300);
    });

    // Saat submit, hanya data kelas yang dipilih dikirim
    $('form').on('submit', function () {
      const selectedKelas = $('#kelas_yang_dipilih').val();

      $('[data-kelas-id]').each(function () {
        const currentId = $(this).data('kelas-id').toString();
        if (currentId !== selectedKelas) {
          $(this).find('input, select, textarea').remove();
        }
      });

      return true;
    });
  });
</script>
@endsection

