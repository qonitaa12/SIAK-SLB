<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data orang tua</p>

    <form class="forms-sample" id="formTambahOrangTua" action="{{ route('orangtua.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
        <!-- Kolom Kiri -->
      <div class="col-md-6">
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
          <label for="nama_ayah">Nama Ayah</label>
          <input type="text" class="form-control" name="nama_ayah" id="nama_ayah"  required>
        </div>

        <div class="form-group mb-3">
          <label for="tahun_lahir_ayah">Tahun Lahir Ayah</label>
          <input type="number" class="form-control" name="tahun_lahir_ayah" id="tahun_lahir_ayah" required>
        </div>

        <div class="form-group mb-3">
          <label for="pendidikan_ayah">Pendidikan Ayah</label>
          <select class="form-control" name="pendidikan_ayah" id="pendidikan_ayah" style="color: black; background-color: white;" required>
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
          <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
          <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" required>
        </div>

        <div class="form-group mb-3">
          <label for="penghasilan_ayah">Penghasilan Ayah</label>
          <input type="text" class="form-control" name="penghasilan_ayah" id="penghasilan_ayah" required>
        </div>

        <div class="form-group mb-3">
          <label for="nik_ayah">NIK Ayah</label>
          <input type="text" class="form-control" name="nik_ayah" id="nik_ayah" required>
        </div>

      </div>

      <div class="col-md-6">
        <div class="form-group mb-3">
          <label for="nama_ibu">Nama Ibu</label>
          <input type="text" class="form-control" name="nama_ibu" id="nama_ibu"  required>
        </div>

        <div class="form-group mb-3">
          <label for="tahun_lahir_ibu">Tahun Lahir Ibu</label>
          <input type="number" class="form-control" name="tahun_lahir_ibu" id="tahun_lahir_ibu" required>
        </div>

        <div class="form-group mb-3">
          <label for="pendidikan_ibu">Pendidikan Ibu</label>
          <select class="form-control" name="pendidikan_ibu" id="pendidikan_ibu" style="color: black; background-color: white;" required>
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
          <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
          <input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" required>
        </div>

        <div class="form-group mb-3">
          <label for="penghasilan_ibu">Penghasilan Ibu</label>
          <input type="text" class="form-control" name="penghasilan_ibu" id="penghasilan_ibu" required>
        </div>

        <div class="form-group mb-3">
          <label for="nik_ibu">NIK Ibu</label>
          <input type="text" class="form-control" name="nik_ibu" id="nik_ibu" required>
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

