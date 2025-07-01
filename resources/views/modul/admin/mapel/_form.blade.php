<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data mata pelajaran</p>

    <form class="forms-sample" id="formTambahMapel" action="{{ route('mapel.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
          </div>

          <div class="form-group mb-3">
            <label for="jumlah_penilaian">Jumlah Penilaian</label>
            <input type="number" class="form-control" name="jumlah_penilaian" id="jumlah_penilaian" placeholder="Jumlah Penilaian" required>
          </div>
          
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary text-white">Simpan</button>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
        </div>
    </form>
  </div>
</div>

