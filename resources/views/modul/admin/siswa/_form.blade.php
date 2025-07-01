<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data siswa</p>

    <form class="forms-sample" id="formTambahSiswa" action="{{ route('siswa.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" required>
          </div>

          <div class="form-group mb-3">
            <label for="nipd">NIPD</label>
            <input type="number" class="form-control" name="nipd" id="nipd" placeholder="NIPD" required>
          </div>

          <div class="form-group mb-3">
            <label for="nisn">NISN</label>
            <input type="number" class="form-control" name="nisn" id="nisn" placeholder="NISN" required>
          </div>

          <div class="form-group mb-3">
            <div class="border rounded p-3">
            <label>Gender</label>
              <div class="form-group mb-3">
                  <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki-laki" checked >
                  <label class="form-check-label" for="gender1">Laki-laki</label>
              </div>
                <div class="form-group mb-3">
                  <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan" required>
                  <label class="form-check-label" for="gender2">Perempuan</label>
                </div>
              </div>
          </div>

          <div class="form-group mb-3">
            <label for="tempat_lahir">Tempat lahir</label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat lahir" required>
          </div>

          <div class="form-group mb-3">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
          </div>

          <div class="form-group mb-3">
            <label for="nik">NIK</label>
            <input type="number" class="form-control" name="nik" id="nik" placeholder="NIK" required>
          </div>

          <div class="form-group mb-3">
            <label for="agama">Agama</label>
            <select class="form-control" name="agama" id="agama" required>
              <option value="">-- Pilih Agama --</option>
              <option value="Islam">Islam</option>
              <option value="Kristen">Kristen</option>
              <option value="Katolik">Katolik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Konghucu">Konghucu</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>

          <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>
          </div>

          <div class="form-group mb-3">
            <label for="jenis_tinggal">Jenis tinggal</label>
            <input type="text" class="form-control" name="jenis_tinggal" id="jenis_tinggal" placeholder="Jenis Tinggal" required>
          </div>

          <div class="form-group mb-3">
            <label for="alat_transportasi">Alat Transportasi</label>
            <input type="text" class="form-control" name="alat_transportasi" id="alat_transportasi" placeholder="Alat Transportasi" required>
          </div>

          <div class="form-group mb-3">
            <label for="no_hp">No Hp</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" required>
          </div>

          <div class="form-group mb-3">
            <label for="kebutuhan_khusus">Kebutuhan khusus</label>
            <input type="text" class="form-control" name="kebutuhan_khusus" id="kebutuhan_khusus" placeholder="Kebutuhan Khusus" required>
          </div>

        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
          <div class="form-group mb-3">
            <label for="anak_ke">Anak ke</label>
            <input type="number" class="form-control" name="anak_ke" id="anak_ke" placeholder="Anak ke" required>
          </div>

          <div class="form-group mb-3">
            <label for="jarak_rumah">Jarak rumah (km)</label>
            <input type="number" class="form-control" name="jarak_rumah" id="jarak_rumah" placeholder="Jarak Rumah (KM)" required>
          </div>

          <div class="form-group mb-3">
          <div class="border rounded p-3">
            <label>Penerima KPS</label>
            <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kps" id="kps1" value="Ya">
                <label class="form-check-label" for="kps1">Ya</label>
              </div>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kps" id="kps2" value="Tidak">
                <label class="form-check-label" for="kps2">Tidak</label>
              </div>
            </div>
          </div>

          <div class="form-group mb-3" id="field_no_kps">
            <label for="no_kps">No KPS</label>
            <input type="number" class="form-control" name="no_kps" id="no_kps" placeholder="No KPS">
          </div>

          <div class="form-group mb-3">
          <div class="border rounded p-3">
            <label>Penerima KIP</label>
            <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kip" id="kip1" value="Ya">
                <label class="form-check-label" for="kip1">Ya</label>
              </div>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="penerima_kip" id="kip2" value="Tidak">
                <label class="form-check-label" for="kip2">Tidak</label>
              </div>
            </div>
          </div>

          <div class="form-group mb-3" id="field_no_kip">
            <label for="no_kip">No KIP</label>
            <input type="number" class="form-control" name="no_kip" id="no_kip" placeholder="No KIP">
          </div>

          <div class="form-group mb-3" id="field_nama_kip">
            <label for="nama_kip">Nama KIP</label>
            <input type="text" class="form-control" name="nama_kip" id="nama_kip" placeholder="Nama KIP">
          </div>

          <div class="form-group mb-3" id="field_no_kks">
            <label for="no_kks">No KKS</label>
            <input type="number" class="form-control" name="no_kks" id="no_kks" placeholder="No KKS">
          </div>

          <div class="form-group mb-3">
          <div class="border rounded p-3">
            <label>Layak KIP</label>
            <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="layak_kip" id="layak1" value="Ya" >
                <label class="form-check-label" for="layak1">Ya</label>
              </div>
              <div class="form-group mb-3">
                <input class="form-check-input" type="radio" name="layak_kip" id="layak2" value="Tidak">
                <label class="form-check-label" for="layak2">Tidak</label>
              </div>
            </div>
          </div>

          <div class="form-group mb-3" id="field_alasan_layak">
            <label for="alasan_layak">Alasan layak</label>
            <input type="text" class="form-control" name="alasan_layak" id="alasan_layak" placeholder="Alasan layak">
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

    $.ajax({
      url: '{{ route("siswa.store") }}',
      method: 'POST',
      data: $('#formTambahSiswa').serialize(),
      success: function(response) {
        console.log(response);
      },
      error: function(xhr) {
        console.log("Error", xhr.responseText);
      }
    });
  });
</script>
