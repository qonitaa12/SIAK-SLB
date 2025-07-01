<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data kelas siswa</p>

    <form class="forms-sample" id="formTambahKelassiswa" action="{{ route('kelas_siswa.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
      <div class="form-group mb-3">
          <label for="tahun">Tahun</label>
          <input type="number" class="form-control" name="tahun" id="tahun" required>
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

        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" style="color: black; background-color: white;" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option value="{{ $item->id }}" data-nisn="{{ $item->nisn }}">{{ $item->nama }} - {{ $item->nisn }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="nisn">NISN</label>
          <input type="text" id="nisn" name="nisn" class="form-control" readonly style="color: black; background-color: white;">
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Simpan</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
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
