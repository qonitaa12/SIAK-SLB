<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data kelas siswa</p>

    <form class="forms-sample" id="formEditKelassiswa" action="{{ route('kelas_siswa.update', $kelas_siswa->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
      <div class="form-group mb-3">
          <label for="tahun">Tahun</label>
          <input type="text" class="form-control" name="tahun" id="tahun" value="{{ $kelas_siswa->tahun }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="id_kelas">Nama Kelas</label>
          <select name="id_kelas" id="id_kelas" class="form-control select2" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $item)
              <option value="{{ $item->id }}" {{ $kelas_siswa->id_kelas == $item->id ? 'selected' : '' }}>{{ $item->nama_kelas }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option 
                value="{{ $item->id }}" 
                data-nisn="{{ $item->nisn }}"
                {{ $kelas_siswa->id_siswa == $item->id ? 'selected' : '' }}>
                {{ $item->nama }} - {{ $item->nisn }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="nisn">NISN</label>
          <input type="text" id="nisn" name="nisn" class="form-control" readonly style="color: black; background-color: white;">
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
