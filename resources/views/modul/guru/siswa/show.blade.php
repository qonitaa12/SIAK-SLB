<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Detail Data Siswa</p>

    <form class="forms-sample">
      <div class="row">
        <div class="form-group mb-3 col-md-6">
          <label>Nama</label>
          <input type="text" class="form-control" value="{{ $siswa->nama }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>NIPD</label>
          <input type="text" class="form-control" value="{{ $siswa->nipd }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>NISN</label>
          <input type="text" class="form-control" value="{{ $siswa->nisn }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Tempat Lahir</label>
          <input type="text" class="form-control" value="{{ $siswa->tempat_lahir }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Tanggal Lahir</label>
          <input type="date" class="form-control" value="{{ $siswa->tanggal_lahir }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>NIK</label>
          <input type="text" class="form-control" value="{{ $siswa->nik }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Agama</label>
          <input type="text" class="form-control" value="{{ $siswa->agama }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Alamat</label>
          <textarea class="form-control" rows="2" readonly>{{ $siswa->alamat }}</textarea>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Jenis Tinggal</label>
          <input type="text" class="form-control" value="{{ $siswa->jenis_tinggal }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Alat Transportasi</label>
          <input type="text" class="form-control" value="{{ $siswa->alat_transportasi }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>No HP</label>
          <input type="text" class="form-control" value="{{ $siswa->no_hp }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Kebutuhan Khusus</label>
          <input type="text" class="form-control" value="{{ $siswa->kebutuhan_khusus }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Anak Ke-</label>
          <input type="number" class="form-control" value="{{ $siswa->anak_ke }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Jarak Rumah</label>
          <input type="text" class="form-control" value="{{ $siswa->jarak_rumah }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Jenis Kelamin</label>
          <input type="text" class="form-control" value="{{ $siswa->gender }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Penerima KPS</label>
          <input type="text" class="form-control" value="{{ $siswa->penerima_kps }}" readonly>
        </div>

        @if($siswa->penerima_kps == '1')
        <div class="form-group mb-3 col-md-6">
          <label>No KPS</label>
          <input type="text" class="form-control" value="{{ $siswa->no_kps }}" readonly>
        </div>
        @endif

        <div class="form-group mb-3 col-md-6">
          <label>Penerima KIP</label>
          <input type="text" class="form-control" value="{{ $siswa->penerima_kip }}" readonly>
        </div>

        @if($siswa->penerima_kip == '1')
        <div class="form-group mb-3 col-md-6">
          <label>No KIP</label>
          <input type="text" class="form-control" value="{{ $siswa->no_kip }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Nama KIP</label>
          <input type="text" class="form-control" value="{{ $siswa->nama_kip }}" readonly>
        </div>
        @endif

        <div class="form-group mb-3 col-md-6">
          <label>Layak KIP</label>
          <input type="text" class="form-control" value="{{ $siswa->layak_kip }}" readonly>
        </div>

        @if($siswa->layak_kip == '1')
        <div class="form-group mb-3 col-md-6">
          <label>No KKS</label>
          <input type="text" class="form-control" value="{{ $siswa->no_kks }}" readonly>
        </div>

        <div class="form-group mb-3 col-md-6">
          <label>Alasan Layak</label>
          <textarea class="form-control" rows="2" readonly>{{ $siswa->alasan_layak }}</textarea>
        </div>
        @endif

      </div>

      <div class="text-end mt-4">
        <a href="{{ route('guru.siswa.index') }}" class="btn btn-light">Kembali</a>
      </div>
    </form>
  </div>
</div>
