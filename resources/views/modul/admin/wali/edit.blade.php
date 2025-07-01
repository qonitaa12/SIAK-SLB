<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data wali</p>

    <form class="forms-sample" id="formEditWali" action="{{ route('wali.update', $wali->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option 
                value="{{ $item->id }}" 
                data-nisn="{{ $item->nisn }}"
                {{ $wali->id_siswa == $item->id ? 'selected' : '' }}>
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
          <label for="nama_wali">Nama Wali</label>
          <input type="text" class="form-control" name="nama_wali" id="nama_wali" value="{{ $wali->nama_wali }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="tahun_lahir_wali">Tahun Lahir Wali</label>
          <input type="number" class="form-control" name="tahun_lahir_wali" id="tahun_lahir_wali" value="{{ $wali->tahun_lahir_wali }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="pendidikan_wali">Pendidikan Wali</label>
          <input type="text" class="form-control" name="pendidikan_wali" id="pendidikan_wali" value="{{ $wali->pendidikan_wali }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="pekerjaan_wali">Pekerjaan Wali</label>
          <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan_wali" value="{{ $wali->pekerjaan_wali }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="penghasilan_wali">Penghasilan Wali</label>
          <input type="text" class="form-control" name="penghasilan_wali" id="penghasilan_wali" value="{{ $wali->penghasilan_wali }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="nik_wali">NIK Wali</label>
          <input type="text" class="form-control" name="nik_wali" id="nik_wali" value="{{ $wali->nik_wali }}" required>
        </div>
      </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Update</button>
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

