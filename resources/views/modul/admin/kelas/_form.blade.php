<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data kelas</p>

    <form class="forms-sample" id="formTambahKelas" action="{{ route('kelas.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
          <div class="form-group mb-3">
            <label for="nama_kelas">Nama kelas</label>
            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama kelas" required>
          </div>
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary text-white">Simpan</button>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
        </div>
    </form>
  </div>
</div>

