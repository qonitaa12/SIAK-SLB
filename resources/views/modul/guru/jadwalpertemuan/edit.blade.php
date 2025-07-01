<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data jadwal pertemuan</p>

    <form class="forms-sample" id="formEditJadwalpertemuan" action="{{ route('guru.jadwal_pertemuan.update', $jadwal_pertemuan->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="form-group mb-3">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $jadwal_pertemuan->tanggal }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="waktu">Waktu</label>
          <input type="time" class="form-control" name="waktu" id="waktu" value="{{ $jadwal_pertemuan->waktu }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="tempat">Tempat</label>
          <input type="text" class="form-control" name="tempat" id="tempat" value="{{ $jadwal_pertemuan->tempat }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach ($siswaList as $siswa)
              <option value="{{ $siswa->id }}" {{ ($jadwal_pertemuan->id_wali == optional($siswa->wali)->id || $jadwal_pertemuan->id_orangtua == optional($siswa->orangTua)->id) ? 'selected' : '' }}>
                {{ $siswa->nama }} ({{ $siswa->nisn }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_guru">Nama Guru</label>
          <select name="id_guru" id="id_guru" class="form-control select2" required>
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $item)
              <option value="{{ $item->id }}" {{ $item->id == $jadwal_pertemuan->id_guru ? 'selected' : '' }}>
                {{ $item->nip }} - {{ $item->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="status">Status</label>
          <select name="status" id="status" class="form-control" required>
            <option value="Terjadwal" {{ $jadwal_pertemuan->status == 'Terjadwal' ? 'selected' : '' }}>Terjadwal</option>
            <option value="Selesai" {{ $jadwal_pertemuan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
          </select>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Update</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
