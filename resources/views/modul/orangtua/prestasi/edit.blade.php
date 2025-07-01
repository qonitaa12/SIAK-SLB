<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit prestasi</p>

    <form class="forms-sample" id="formEditPrestasi" action="{{ route('orangtua.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data"  onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
      <div class="form-group mb-3">
          <label for="lomba">Lomba</label>
          <input type="text" class="form-control" name="lomba" id="lomba" value="{{ $prestasi->lomba }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="tingkat">Tingkat</label>
          <input type="text" class="form-control" name="tingkat" id="tingkat" value="{{ $prestasi->tingkat }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="juara">Juara</label>
          <input type="text" class="form-control" name="juara" id="juara" value="{{ $prestasi->juara }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $prestasi->tanggal }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="dokumentasi">Dokumentasi</label>
          <input type="file" class="form-control" name="dokumentasi" id="dokumentasi" accept="image/*">
          </div>

        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option value="{{ $item->id }}" {{ $prestasi->id_siswa == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Update</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
