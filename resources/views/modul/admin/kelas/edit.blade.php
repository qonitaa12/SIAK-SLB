<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data kelas</p>

    <form class="forms-sample" id="formEditKelas" action="{{ route('kelas.update', $kelas->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
          <div class="form-group mb-3">
            <label for="nama_kelas">Nama kelas</label>
            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" value="{{ $kelas->nama_kelas }}" required>
          </div>
         
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary text-white">Update</button>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
    </form>
  </div>
</div>

