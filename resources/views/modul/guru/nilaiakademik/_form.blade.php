<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data nilai akademik</p>

    <form id="formTambahNilaiAkademik" action="{{ route('guru.nilai_akademik.store') }}" method="POST" onsubmit="return confirm('Yakin kirim data?')">
      @csrf

      <div class="row">
        <!-- Nama Siswa -->
        <div class="form-group mb-3">
          <label for="id_kelas_siswa">Nama Siswa</label>
          <select name="id_kelas_siswa" id="id_kelas_siswa" class="form-select" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($kelas_siswa as $item)
              <option value="{{ $item->id }}">{{ $item->siswa->nama ?? '-' }}</option>
            @endforeach
          </select>
        </div>

        <!-- Mapel -->
        <div class="form-group mb-3">
          <label for="id_mapel">Mata Pelajaran</label>
          <select name="id_mapel" id="id_mapel" class="form-select" required>
            <option value="">-- Pilih Mapel --</option>
            @foreach($guru_mapel as $item)
              <option value="{{ $item->mapel->id }}">{{ $item->mapel->nama }}</option>
            @endforeach
          </select>
        </div>

        <!-- Auto-filled -->
        <input type="hidden" name="id_guru_mapel" id="id_guru_mapel">
        <div class="form-group mb-3">
          <label>Semester</label>
          <input type="text" class="form-control" id="semester" name="semester" readonly>
        </div>

        <div class="form-group mb-3">
          <label>Guru</label>
          <input type="text" class="form-control" id="guru" name="guru" readonly>
        </div>

        <!-- Penilaian Formatif -->
        <div class="form-group mb-3">
          <label>Nilai Formatif</label>
          <div id="formatif-wrapper">
            <div class="row mb-2">
              <div class="col"><input type="number" name="formatif[0][nilai]" class="form-control" placeholder="Nilai" min="0" max="100" ></div>
              <div class="col"><input type="text" name="formatif[0][keterangan]" class="form-control" placeholder="Keterangan"></div>
              <div class="col-auto"><button type="button" class="btn btn-success btn-sm" onclick="tambahForm('formatif')">+</button></div>
            </div>
          </div>
          <div class="mt-2">
            <label for="bobot_formatif">Bobot Formatif (%)</label>
            <input type="number" name="bobot_formatif" class="form-control" placeholder="Bobot formatif" min="0" max="100">
          </div>
        </div>

        <!-- Sumatif CP -->
        <div class="form-group mb-3">
          <label>Nilai Sumatif CP</label>
          <div id="sumatif-wrapper">
            <div class="row mb-2">
              <div class="col"><input type="number" name="sumatif_cp[0][nilai]" class="form-control" placeholder="Nilai" min="0" max="100" ></div>
              <div class="col"><input type="text" name="sumatif_cp[0][keterangan]" class="form-control" placeholder="Keterangan"></div>
              <div class="col-auto"><button type="button" class="btn btn-success btn-sm" onclick="tambahForm('sumatif_cp')">+</button></div>
            </div>
          </div>
          <div class="mt-2">
            <label for="bobot_sumatif_cp">Bobot Sumatif CP (%)</label>
            <input type="number" name="bobot_sumatif_cp" class="form-control" placeholder="Bobot sumatif CP" min="0" max="100">
          </div>
        </div>

        <!-- Sumatif Semester -->
        <div class="form-group mb-3">
          <label>Nilai Sumatif Semester</label>
          <div id="sumatif_semester-wrapper">
            <div class="row mb-2">
              <div class="col"><input type="number" name="sumatif_semester[0][nilai]" class="form-control" placeholder="Nilai" min="0" max="100" ></div>
              <div class="col"><input type="text" name="sumatif_semester[0][keterangan]" class="form-control" placeholder="Keterangan"></div>
              <div class="col-auto"><button type="button" class="btn btn-success btn-sm" onclick="tambahForm('sumatif_semester')">+</button></div>
            </div>
          </div>
          <div class="mt-2">
            <label for="bobot_sumatif_semester">Bobot Sumatif Semester (%)</label>
            <input type="number" name="bobot_sumatif_semester" class="form-control" placeholder="Bobot sumatif semester" min="0" max="100">
          </div>
        </div>

        <!-- Tingkat Akhir -->
        <div class="form-group mb-3">
          <label>Nilai Tingkat Akhir</label>
          <div id="tingkat_akhir-wrapper">
            <div class="row mb-2">
              <div class="col"><input type="number" name="tingkat_akhir[0][nilai]" class="form-control" placeholder="Nilai" min="0" max="100"></div>
              <div class="col"><input type="text" name="tingkat_akhir[0][keterangan]" class="form-control" placeholder="Keterangan"></div>
              <div class="col-auto"><button type="button" class="btn btn-success btn-sm" onclick="tambahForm('tingkat_akhir')">+</button></div>
            </div>
          </div>
          <div class="mt-2">
            <label for="bobot_tingkat_akhir">Bobot Tingkat Akhir (%)</label>
            <input type="number" name="bobot_tingkat_akhir" class="form-control" placeholder="Bobot tingkat akhir" min="0" max="100">
          </div>
        </div>


        <div class="form-group mb-3">
          <label>Evaluasi</label>
          <textarea name="evaluasi" class="form-control" rows="2" placeholder="Tulis evaluasi akhir siswa..."></textarea>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- JS Dinamis --}}
<script>
  function tambahForm(section) {
  let wrapper = document.getElementById(section + '-wrapper');
  let index = wrapper.children.length;

  let html = `
    <div class="row mb-2">
      <div class="col"><input type="number" name="${section}[${index}][nilai]" class="form-control" placeholder="Nilai" min="0" max="100" required></div>
      <div class="col"><input type="text" name="${section}[${index}][keterangan]" class="form-control" placeholder="Keterangan"></div>
      <div class="col-auto"><button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.remove()">-</button></div>
    </div>
  `;

  wrapper.insertAdjacentHTML('beforeend', html);
}


  $('#id_mapel, #id_kelas_siswa').on('change', function () {
    const id_mapel = $('#id_mapel').val();
    const id_kelas_siswa = $('#id_kelas_siswa').val();

    if (id_mapel && id_kelas_siswa) {
      $.ajax({
        url: `{{ route('guru.nilai_akademik.get_guru_mapel') }}`,
        type: 'POST', // <- tambahkan baris ini
        data: {
          _token: '{{ csrf_token() }}',
          id_mapel: id_mapel,
          id_kelas_siswa: id_kelas_siswa
        },
        success: function (res) {
          $('#semester').val(res.semester);
          $('#guru').val(res.nama_guru);
          $('#id_guru_mapel').val(res.id_guru_mapel);
        },
        error: function () {
          alert('Data guru untuk kelas dan mapel ini tidak ditemukan.');
          $('#semester, #guru, #id_guru_mapel').val('');
        }
      });
    }
  });
</script>
