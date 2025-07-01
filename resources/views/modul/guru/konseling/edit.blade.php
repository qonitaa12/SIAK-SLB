<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data konseling</p>

    <form class="forms-sample" id="formEditKonseling" action="{{ route('guru.konseling.update', $konseling->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="form-group mb-3">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $konseling->tanggal }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="kesehatan">Kesehatan</label>
          <input type="text" class="form-control" name="kesehatan" id="kesehatan" value="{{ $konseling->kesehatan }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="catatan">Catatan</label>
          <input type="text" class="form-control" name="catatan" id="catatan" value="{{ $konseling->catatan }}" required>
        </div>

         <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option 
                value="{{ $item->id }}" 
                data-nisn="{{ $item->nisn }}"
                {{ $konseling->id_siswa == $item->id ? 'selected' : '' }}>
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
          <label for="id_guru">Nama Guru</label>
          <select name="id_guru" id="id_guru" class="form-control select2" required>
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $item)
              <option value="{{ $item->id }}" {{ $konseling->id_guru == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach
          </select>
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

