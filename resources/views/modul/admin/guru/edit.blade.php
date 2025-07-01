<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data guru</p>

    <form class="forms-sample" id="formEditGuru" action="{{ route('guru.update', $guru->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
          <div class="form-group mb-3">
            <label for="nip">NIP</label>
            <input type="text" class="form-control" name="nip" id="nip" value="{{ $guru->nip }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ $guru->nama }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="bidang_ajar">Bidang Ajar</label>
            <input type="text" class="form-control" name="bidang_ajar" id="bidang_ajar" value="{{ $guru->bidang_ajar }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $guru->jabatan }}" required>
          </div>
          
          <div class="form-group mb-3">
            <label for="kontak">Kontak</label>
            <input type="text" class="form-control" name="kontak" id="kontak" value="{{ $guru->kontak }}" required>
          </div>
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary text-white">Update</button>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
    </form>
  </div>
</div>

          