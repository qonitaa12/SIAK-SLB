<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data wali</p>

    <form class="forms-sample" id="formTambahWali" action="{{ route('wali.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
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
          <label for="nama_wali">Nama Wali</label>
          <input type="text" class="form-control" name="nama_wali" id="nama_wali"  required>
        </div>

        <div class="form-group mb-3">
          <label for="tahun_lahir_wali">Tahun Lahir Wali</label>
          <input type="number" class="form-control" name="tahun_lahir_wali" id="tahun_lahir_wali" required>
        </div>

        <div class="form-group mb-3">
          <label for="pendidikan_wali">Pendidikan Wali</label>
          <select class="form-control" name="pendidikan_wali" id="pendidikan_wali" style="color: black; background-color: white;" required>
            <option value="">-- Pilih Pendidikan --</option>
            <option value="Tidak Sekolah">Tidak Sekolah</option>
            <option value="SD">SD</option>
            <option value="SMP">SMP</option>
            <option value="SMA">SMA</option>
            <option value="D1">D1</option>
            <option value="D2">D2</option>
            <option value="D3">D3</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="pekerjaan_wali">Pekerjaan Wali</label>
          <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan_wali" required>
        </div>

        <div class="form-group mb-3">
          <label for="penghasilan_wali">Penghasilan Wali</label>
          <input type="text" class="form-control" name="penghasilan_wali" id="penghasilan_wali" required>
        </div>

        <div class="form-group mb-3">
          <label for="nik_wali">NIK Wali</label>
          <input type="text" class="form-control" name="nik_wali" id="nik_wali" required>
        </div>

      </div>
      
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


