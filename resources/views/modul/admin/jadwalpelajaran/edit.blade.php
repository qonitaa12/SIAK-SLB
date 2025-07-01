<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data jadwal pelajaran</p>

    <form class="forms-sample" id="formEditJadwalpelajaran" action="{{ route('jadwal_pelajaran.update', $jadwal_pelajaran->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
        
        <div class="form-group mb-3">
          <label for="hari">Hari</label>
          <select name="hari" id="hari" class="form-control" required>
            <option value="">-- Pilih Hari --</option>
            @php
              $daftar_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            @endphp
            @foreach($daftar_hari as $hari)
              <option value="{{ $hari }}" {{ $jadwal_pelajaran->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="jam_mulai">Jam Mulai</label>
          <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="{{ $jadwal_pelajaran->jam_mulai }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="jam_selesai">Jam Selesai</label>
          <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="{{ $jadwal_pelajaran->jam_selesai }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="id_kelas">Nama Kelas</label>
          <select name="id_kelas" id="id_kelas" class="form-control select2" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $item)
              <option 
                value="{{ $item->id }}" 
                {{ $jadwal_pelajaran->id_kelas == $item->id ? 'selected' : '' }}>
                {{ $item->nama_kelas }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_mapel">Nama Mapel</label>
          <select name="id_mapel" id="id_mapel" class="form-control select2" required>
            <option value="">-- Pilih Mapel --</option>
            @foreach($mapel as $item)
              <option 
                value="{{ $item->id }}" 
                {{ $jadwal_pelajaran->id_mapel == $item->id ? 'selected' : '' }}>
                {{ $item->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_guru">Nama Guru</label>
          <select name="id_guru" id="id_guru" class="form-control select2" required>
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $item)
              <option 
                value="{{ $item->id }}" 
                {{ $jadwal_pelajaran->id_guru == $item->id ? 'selected' : '' }}>
                {{ $item->nama }}
              </option>
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
