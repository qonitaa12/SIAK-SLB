<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Detail Absensi</p>

    <div class="form-group mb-3">
      <label for="tanggal">Tanggal</label>
      <input type="text" class="form-control" value="{{ $absensi->tanggal->format('Y-m-d') }}" readonly>
    </div>

    <div class="form-group mb-3">
      <label for="id_guru">Nama Guru</label>
      <input type="text" class="form-control" value="{{ optional($absensi->guru)->nama ?? '-' }}" readonly>
    </div>

    <div class="card mb-4">
      <div class="card-header bg-light">
        <strong>{{ $kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</strong>
      </div>
      <div class="card-body">
        @php
          $siswa_data = $absensi->data_siswa ?? [];
        @endphp

        @if ($kelas_siswa->count())
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
                @foreach ($kelas_siswa as $item)
                  @php
                    $siswa = $item->siswa;
                    $data = $siswa_data[$siswa->id] ?? [];
                  @endphp
                  <tr>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $data['status'] ?? '-' }}</td>
                    <td>{{ $data['keterangan'] ?? '-' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <p class="text-muted">Data absensi tidak ditemukan untuk siswa ini.</p>
        @endif
      </div>
    </div>

    <div class="form-group mb-3">
      <label for="dokumentasi">Dokumentasi</label><br>
      @if ($absensi->dokumentasi)
        <a href="{{ asset('storage/' . $absensi->dokumentasi) }}" target="_blank">Lihat dokumentasi</a>
      @else
        <p class="text-muted">Tidak ada dokumentasi.</p>
      @endif
    </div>

    <div class="text-end">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
  </div>
</div>
