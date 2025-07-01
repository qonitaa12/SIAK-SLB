<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data konseling</p>

    <form class="forms-sample" id="formTambahKonseling" action="{{ route('guru.konseling.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
        <div class="form-group mb-3">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" name="tanggal" id="tanggal" required>
        </div>

        <div class="form-group mb-3">
          <label for="kesehatan">Kesehatan</label>
          <input type="teks" class="form-control" name="kesehatan" id="kesehatan" required>
        </div>

        <div class="form-group mb-3">
          <label for="catatan">Catatan</label>
          <input type="teks" class="form-control" name="catatan" id="catatan" required>
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

        <div class="form-group mb-3">
          <label for="id_guru">Nama Guru</label>
          <select name="id_guru" id="id_guru" class="form-control select2" style="color: black; background-color: white;" required>
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $item)
              <option value="{{ $item->id }}">{{ $item->nama }}</option>
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

<script>
    document.getElementById('id_siswa').addEventListener('change', function() {
        var selected = this.options[this.selectedIndex];
        var nisn = selected.getAttribute('data-nisn');
        document.getElementById('nisn').value = nisn ? nisn : '';
    });
</script>
