<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Ubah data absensi</p>

    <form action="{{ route('absensi_admin.update', $absensi->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')

      <div class="form-group mb-3">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="{{ $absensi->tanggal->format('Y-m-d') }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="id_guru">Nama Guru</label>
        <select name="id_guru" class="form-control select2" required>
          <option value="">-- Pilih Guru --</option>
          @foreach ($guru as $g)
            <option value="{{ $g->id }}" {{ $g->id == $absensi->id_guru ? 'selected' : '' }}>{{ $g->nama }}</option>
          @endforeach
        </select>
      </div>

      <input type="hidden" name="id_kelas" value="{{ $absensi->id_kelas }}">

      <div class="card mb-4">
        <div class="card-header bg-light">
          <strong>{{ \App\Models\Kelas::find($absensi->id_kelas)->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</strong>
        </div>
        <div class="card-body">
          @php
            $siswa_data = $absensi->data_siswa ?? [];
            $kelas_siswa_list = \App\Models\KelasSiswa::with('siswa')
              ->where('id_kelas', $absensi->id_kelas)
              ->whereNull('deleted_at')
              ->get();
          @endphp

          @if ($kelas_siswa_list->count())
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kelas_siswa_list as $item)
                    @php
                      $siswa = $item->siswa;
                      $data = $siswa_data[$siswa->id] ?? [];
                    @endphp
                    <tr>
                      <td>{{ $siswa->nama }}</td>
                      <td>
                        <select name="data_siswa[{{ $siswa->id }}][status]" class="form-control">
                          <option value="Hadir" {{ ($data['status'] ?? '') === 'Hadir' ? 'selected' : '' }}>Hadir</option>
                          <option value="Izin" {{ ($data['status'] ?? '') === 'Izin' ? 'selected' : '' }}>Izin</option>
                          <option value="Tidak Hadir" {{ ($data['status'] ?? '') === 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" name="data_siswa[{{ $siswa->id }}][keterangan]" class="form-control" value="{{ $data['keterangan'] ?? '' }}">
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p class="text-muted">Tidak ada siswa dalam kelas ini.</p>
          @endif
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="dokumentasi">Dokumentasi</label>
        <input type="file" name="dokumentasi" class="form-control" accept="image/*">
        @if ($absensi->dokumentasi)
          <p class="mt-2">
            <a href="{{ asset('storage/' . $absensi->dokumentasi) }}" target="_blank">Lihat dokumentasi saat ini</a>
          </p>
        @endif
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-primary text-white">Update</button>
        <a href="{{ route('absensi_admin.index') }}" class="btn btn-light">Batal</a>
      </div>
    </form>
  </div>
</div>

@section('js')
<script>
  $(document).ready(function () {
    $('.select2').select2();
  });
</script>
@endsection
