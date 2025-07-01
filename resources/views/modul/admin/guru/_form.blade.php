<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data guru</p>

    <form class="forms-sample" id="formTambahGuru" action="{{ route('guru.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
          <div class="form-group mb-3">
            <label for="nip">NIP</label>
            <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP" required>
          </div>

          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
          </div>

          <div class="form-group mb-3">
            <label for="bidang_ajar">Bidang Ajar</label>
            <input type="text" class="form-control" name="bidang_ajar" id="bidang_ajar" placeholder="Bidang Ajar" required>
          </div>


          <div class="form-group mb-3">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" required>
          </div>

         
          <div class="form-group mb-3">
            <label for="kontak">Kontak</label>
            <input type="number" class="form-control" name="kontak" id="kontak" placeholder="Kontak" required>
          </div>
          
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary text-white">Simpan</button>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
        </div>
    </form>
  </div>
</div>


