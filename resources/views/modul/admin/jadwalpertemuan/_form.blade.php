<form class="forms-sample" id="formTambahJadwalpertemuan" action="{{ route('jadwal_pertemuan.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
  @csrf
  <div class="row">
    <div class="form-group mb-3">
      <label for="tanggal">Tanggal</label>
      <input type="date" class="form-control" name="tanggal" id="tanggal" required>
    </div>

    <div class="form-group mb-3">
      <label for="waktu">Waktu</label>
      <input type="time" class="form-control" name="waktu" id="waktu" required>
    </div>

    <div class="form-group mb-3">
      <label for="tempat">Tempat</label>
      <input type="text" class="form-control" name="tempat" id="tempat" required>
    </div>

    <div class="form-group mb-3">
      <label for="id_siswa">Nama Siswa</label>
      <select name="id_siswa" id="id_siswa" class="form-control" required>
        <option value="">-- Pilih Siswa --</option>
        @foreach ($siswaList as $siswa)
          <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->nisn }})</option>
        @endforeach
      </select>
    </div>

    <div class="form-group mb-3">
      <label for="id_guru">Nama Guru</label>
      <select name="id_guru" id="id_guru" class="form-control select2" required>
        <option value="">-- Pilih Guru --</option>
        @foreach($guru as $item)
          <option value="{{ $item->id }}">{{ $item->nip }} - {{ $item->nama }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group mb-3">
      <label for="status">Status</label>
      <select name="status" id="status" class="form-control" required>
        <option value="">-- Pilih Status --</option>
        <option value="Terjadwal">Terjadwal</option>
        <option value="Selesai">Selesai</option>
      </select>
    </div>

    <div class="text-end mt-4">
      <button type="submit" class="btn btn-primary text-white">Simpan</button>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
    </div>
  </div>
</form>
