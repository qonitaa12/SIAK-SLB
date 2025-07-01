<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data orang tua</p>

    <form class="forms-sample" id="formEditOrangTua" action="{{ route('orangtua.update', $orang_tua->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
        <!-- Kolom Kiri -->
      <div class="col-md-6">
        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option 
                value="{{ $item->id }}" 
                data-nisn="{{ $item->nisn }}"
                {{ $orang_tua->id_siswa == $item->id ? 'selected' : '' }}>
                {{ $item->nama }} - {{ $item->nisn }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="nisn">NISN</label>
          <input type="text" id="nisn" name="nisn" class="form-control" readonly style="color: black; background-color: white;">
        </div>

        <div class="form-group mb-3">
          <label for="nama_ayah">Nama Ayah</label>
          <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="{{ $orang_tua->nama_ayah }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="tahun_lahir_ayah">Tahun Lahir Ayah</label>
          <input type="number" class="form-control" name="tahun_lahir_ayah" id="tahun_lahir_ayah" value="{{ $orang_tua->tahun_lahir_ayah }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="pendidikan_ayah">Pendidikan Ayah</label>
          <input type="text" class="form-control" name="pendidikan_ayah" id="pendidikan_ayah" value="{{ $orang_tua->pendidikan_ayah }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
          <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ $orang_tua->pekerjaan_ayah }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="penghasilan_ayah">Penghasilan Ayah</label>
          <input type="text" class="form-control" name="penghasilan_ayah" id="penghasilan_ayah" value="{{ $orang_tua->penghasilan_ayah }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="nik_ayah">NIK Ayah</label>
          <input type="text" class="form-control" name="nik_ayah" id="nik_ayah" value="{{ $orang_tua->nik_ayah }}" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group mb-3">
          <label for="nama_ibu">Nama Ibu</label>
          <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="{{ $orang_tua->nama_ibu }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="tahun_lahir_ibu">Tahun Lahir Ibu</label>
          <input type="number" class="form-control" name="tahun_lahir_ibu" id="tahun_lahir_ibu" value="{{ $orang_tua->tahun_lahir_ibu }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="pendidikan_ibu">Pendidikan Ibu</label>
          <input type="text" class="form-control" name="pendidikan_ibu" id="pendidikan_ibu" value="{{ $orang_tua->pendidikan_ibu }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
          <input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ $orang_tua->pekerjaan_ibu }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="penghasilan_ibu">Penghasilan Ibu</label>
          <input type="text" class="form-control" name="penghasilan_ibu" id="penghasilan_ibu" value="{{ $orang_tua->penghasilan_ibu }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="nik_ibu">NIK Ibu</label>
          <input type="text" class="form-control" name="nik_ibu" id="nik_ibu" value="{{ $orang_tua->nik_ibu }}" required>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Update</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>

<script>
    function updateNISN() {
        var select = document.getElementById('id_siswa');
        var selected = select.options[select.selectedIndex];
        var nisn = selected.getAttribute('data-nisn');
        document.getElementById('nisn').value = nisn ? nisn : '';
    }

    // Isi saat pilih berubah
    document.getElementById('id_siswa').addEventListener('change', updateNISN);

    // Isi otomatis saat page load (jika sudah selected)
    window.addEventListener('DOMContentLoaded', updateNISN);
</script>

