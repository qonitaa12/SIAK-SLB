<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data prestasi</p>

    <form class="forms-sample" id="formTambahPrestasi" action="{{ route('guru.prestasi.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Yakin kirim?')">      @csrf
      <div class="row">
      <div class="form-group mb-3">
          <label for="lomba">Lomba</label>
          <input type="text" class="form-control" name="lomba" id="lomba"  required>
        </div>

        <div class="form-group mb-3">
          <label for="tingkat">Tingkat</label>
          <input type="text" class="form-control" name="tingkat" id="tingkat"  required>
        </div>

        <div class="form-group mb-3">
          <label for="juara">Juara</label>
          <input type="text" class="form-control" name="juara" id="juara"  required>
        </div>

        <div class="form-group mb-3">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" name="tanggal" id="tanggal"  required>
        </div>

        <div class="form-group mb-3">
            <label for="dokumentasi">Dokumentasi</label>
            <input type="file" class="form-control" name="dokumentasi" id="dokumentasi" accept="image/*" required>
        </div>

        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" style="color: black; background-color: white;" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option value="{{ $item->id }}" data-nisn="{{ $item->nisn }}">{{ $item->nama }} - {{ $item->nisn }}</option>
            @endforeach
          </select>
        </div>

        <!-- <div class="form-group mb-3">
          <label for="nisn">NISN</label>
          <input type="text" id="nisn" name="nisn" class="form-control" readonly style="color: black; background-color: white;">
        </div> -->

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Simpan</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>

<script>
    document.getElementById('id_siswa').addEventListener('change', function() {
        var selected = this.options[this.selectedIndex];
        var nisn = selected.getAttribute('data-nisn');
        document.getElementById('nisn').value = nisn ? nisn : '';
    });
</script>
