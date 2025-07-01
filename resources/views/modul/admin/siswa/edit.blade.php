<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data siswa</p>

    <form class="forms-sample" id="formEditSiswa" action="{{ route('siswa.update', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ $siswa->nama }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="nipd">NIPD</label>
            <input type="number" class="form-control" name="nipd" id="nipd" value="{{ $siswa->nipd }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="nisn">NISN</label>
            <input type="number" class="form-control" name="nisn" id="nisn" value="{{ $siswa->nisn }}" required>
          </div>

          <div class="form-group mb-3">
            <div class="border rounded p-3">
              <label>Gender</label>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki-laki" {{ $siswa->gender == 'Laki-laki' ? 'checked' : '' }}>
                <label class="form-check-label" for="gender1">Laki-laki</label>
              </div>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan" {{ $siswa->gender == 'Perempuan' ? 'checked' : '' }}>
                <label class="form-check-label" for="gender2">Perempuan</label>
              </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $siswa->tempat_lahir }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="nik">NIK</label>
            <input type="number" class="form-control" name="nik" id="nik" value="{{ $siswa->nik }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="agama">Agama</label>
            <select class="form-control" name="agama" id="agama" required>
              <option value="">-- Pilih Agama --</option>
              @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $agama)
                <option value="{{ $agama }}" {{ $siswa->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $siswa->alamat }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="jenis_tinggal">Jenis Tinggal</label>
            <input type="text" class="form-control" name="jenis_tinggal" id="jenis_tinggal" value="{{ $siswa->jenis_tinggal }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="alat_transportasi">Alat Transportasi</label>
            <input type="text" class="form-control" name="alat_transportasi" id="alat_transportasi" value="{{ $siswa->alat_transportasi }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ $siswa->no_hp }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
            <input type="text" class="form-control" name="kebutuhan_khusus" id="kebutuhan_khusus" value="{{ $siswa->kebutuhan_khusus }}" required>
          </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label for="anak_ke">Anak ke</label>
            <input type="number" class="form-control" name="anak_ke" id="anak_ke" value="{{ $siswa->anak_ke }}" required>
          </div>

          <div class="form-group mb-3">
            <label for="jarak_rumah">Jarak Rumah (km)</label>
            <input type="number" class="form-control" name="jarak_rumah" id="jarak_rumah" value="{{ $siswa->jarak_rumah }}" required>
          </div>

          <!-- Penerima KPS -->
          <div class="form-group mb-3">
            <div class="border rounded p-3">
              <label>Penerima KPS</label>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kps" value="Ya" {{ $siswa->penerima_kps == 'Ya' ? 'checked' : '' }}>
                <label class="form-check-label">Ya</label>
              </div>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kps" value="Tidak" {{ $siswa->penerima_kps == 'Tidak' ? 'checked' : '' }}>
                <label class="form-check-label">Tidak</label>
              </div>
            </div>
          </div>

          <div class="form-group mb-3" id="field_no_kps">
            <label for="no_kps">No KPS</label>
            <input type="number" class="form-control" name="no_kps" id="no_kps" value="{{ $siswa->no_kps }}">
          </div>

          <!-- Penerima KIP -->
          <div class="form-group mb-3">
            <div class="border rounded p-3">
              <label>Penerima KIP</label>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kip" value="Ya" {{ $siswa->penerima_kip == 'Ya' ? 'checked' : '' }}>
                <label class="form-check-label">Ya</label>
              </div>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kip" value="Tidak" {{ $siswa->penerima_kip == 'Tidak' ? 'checked' : '' }}>
                <label class="form-check-label">Tidak</label>
              </div>
            </div>
          </div>

          <div class="form-group mb-3" id="field_no_kip">
            <label for="no_kip">No KIP</label>
            <input type="number" class="form-control" name="no_kip" id="no_kip" value="{{ $siswa->no_kip }}">
          </div>

          <div class="form-group mb-3" id="field_nama_kip">
            <label for="nama_kip">Nama KIP</label>
            <input type="text" class="form-control" name="nama_kip" id="nama_kip" value="{{ $siswa->nama_kip }}">
          </div>

          <div class="form-group mb-3" id="field_no_kks">
            <label for="no_kks">No KKS</label>
            <input type="number" class="form-control" name="no_kks" id="no_kks" value="{{ $siswa->no_kks }}">
          </div>

          <!-- Layak KIP -->
          <div class="form-group mb-3">
            <div class="border rounded p-3">
              <label>Layak KIP</label>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="layak_kip" value="Ya" {{ $siswa->layak_kip == 'Ya' ? 'checked' : '' }}>
                <label class="form-check-label">Ya</label>
              </div>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="layak_kip" value="Tidak" {{ $siswa->layak_kip == 'Tidak' ? 'checked' : '' }}>
                <label class="form-check-label">Tidak</label>
              </div>
            </div>
          </div>

          <div class="form-group mb-3" id="field_alasan_layak">
            <label for="alasan_layak">Alasan Layak</label>
            <input type="text" class="form-control" name="alasan_layak" id="alasan_layak" value="{{ $siswa->alasan_layak }}">
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
  $(document).ready(function () {
    toggleConditionalFields();

    $('input[name="penerima_kps"], input[name="penerima_kip"], input[name="layak_kip"]').change(function () {
      toggleConditionalFields();
    });

    function toggleConditionalFields() {
      toggleFieldByRadio("penerima_kps", "Ya", "field_no_kps", "no_kps");
      toggleFieldByRadio("penerima_kip", "Ya", "field_no_kip", "no_kip");
      toggleFieldByRadio("penerima_kip", "Ya", "field_nama_kip", "nama_kip");
      toggleFieldByRadio("layak_kip", "Ya", "field_alasan_layak", "alasan_layak");
    }

    function toggleFieldByRadio(radioName, expectedValue, fieldId, inputId) {
      const isShow = $(`input[name="${radioName}"]:checked`).val() === expectedValue;
      if (isShow) {
        $(`#${fieldId}`).show();
        $(`#${inputId}`).attr('required', true);
      } else {
        $(`#${fieldId}`).hide();
        $(`#${inputId}`).removeAttr('required').val('');
      }
    }
  });
</script>
