<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data mata pelajaran</p>

    <form class="forms-sample" id="formEditMapel" action="{{ route('mapel.update', $mapel->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ $mapel->nama }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="jumlah_penilaian">Jumlah Penilaian</label>
            <input type="number" class="form-control" name="jumlah_penilaian" id="jumlah_penilaian" value="{{ $mapel->jumlah_penilaian }}" required>
          </div>
          
          <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary text-white">Update</button>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
    </form>
  </div>
</div>

