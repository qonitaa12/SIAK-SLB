<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data guru mapel</p>

    <form class="forms-sample" id="formTambahGurumapel" action="{{ route('guru_mapel.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
      <div class="form-group mb-3">
          <label for="tahun_ajaran">Tahun Ajaran</label>
          <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
      </div>

      <div class="form-group mb-3">
          <label for="semester">Semester</label>
          <input type="text" class="form-control" name="semester" id="semester" required>
      </div>

        <div class="form-group mb-3">
          <label for="id_guru">Nama Guru</label>
          <select name="id_guru" id="id_guru" class="form-control select2" style="color: black; background-color: white;" required>
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $item)
              <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
          </select>
        </div> 

        <div class="form-group mb-3">
          <label for="id_mapel">Mata Pelajaran</label>
          <select name="id_mapel" id="id_mapel" class="form-control select2" style="color: black; background-color: white;" required>
            <option value="">-- Pilih Mata Pelajaran --</option>
            @foreach($mapel as $item)
              <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_kelas">Nama Kelas</label>
          <select name="id_kelas" id="id_kelas" class="form-control select2" style="color: black; background-color: white;" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $item)
              <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
            @endforeach
          </select>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Simpan</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
