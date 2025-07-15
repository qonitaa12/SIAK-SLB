<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Ubah data nilai akademik</p>

    <form id="formEditNilaiAkademik" action="{{ route('guru.nilai_akademik.update', $nilai->id) }}" method="POST" onsubmit="return confirm('Yakin ubah data?')">
      @csrf
      @method('PUT')

      <div class="row">
        <!-- Nama Siswa -->
        <div class="form-group mb-3">
          <label for="id_kelas_siswa">Nama Siswa</label>
          <select name="id_kelas_siswa" id="id_kelas_siswa" class="form-select" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($kelas_siswa as $item)
              <option value="{{ $item->id }}" {{ $nilai->id_kelas_siswa == $item->id ? 'selected' : '' }}>{{ $item->siswa->nama ?? '-' }}</option>
            @endforeach
          </select>
        </div>

        <!-- Mapel -->
        <div class="form-group mb-3">
          <label for="id_mapel">Mata Pelajaran</label>
          <select name="id_mapel" id="id_mapel" class="form-select" required>
            <option value="">-- Pilih Mapel --</option>
            @foreach($guru_mapel as $item)
              <option value="{{ $item->mapel->id }}" {{ $item->mapel->id == $nilai->guruMapel->mapel->id ? 'selected' : '' }}>{{ $item->mapel->nama }}</option>
            @endforeach
          </select>
        </div>

        <input type="hidden" name="id_guru_mapel" id="id_guru_mapel" value="{{ $nilai->id_guru_mapel }}">

        <!-- Semester dan Guru -->
        <div class="form-group mb-3">
          <label>Semester</label>
          <input type="text" class="form-control" id="semester" name="semester" value="{{ $nilai->guruMapel->semester }}" readonly>
        </div>

        <div class="form-group mb-3">
          <label>Guru</label>
          <input type="text" class="form-control" id="guru" name="guru" value="{{ $nilai->guruMapel->guru->nama }}" readonly>
        </div>

        {{-- Penilaian Dinamis --}}
        @php
          $formatif = json_decode($nilai->formatif, true) ?? [];
          $sumatif_cp = json_decode($nilai->sumatif_cp, true) ?? [];
          $sumatif_semester = json_decode($nilai->sumatif_semester, true) ?? [];
          $tingkat_akhir = json_decode($nilai->tingkat_akhir, true) ?? [];
        @endphp

        @php
          $formatif = json_decode($nilai->formatif, true) ?? [];
          if (empty($formatif)) {
              $formatif = [['nilai' => '', 'keterangan' => '']];
          }
        @endphp

        {{-- Formatif --}}
        <div class="form-group mb-3">
          <label>Nilai Formatif</label>
          <div id="formatif-wrapper">
            @foreach($formatif as $i => $f)
              <div class="row mb-2">
                <div class="col"><input type="number" name="formatif[{{ $i }}][nilai]" class="form-control" placeholder="Nilai" value="{{ $f['nilai'] }}" min="0" max="100"></div>
                <div class="col"><input type="text" name="formatif[{{ $i }}][keterangan]" class="form-control" placeholder="Keterangan" value="{{ $f['keterangan'] }}"></div>
                <div class="col-auto">
                  @if ($i == 0)
                    <button type="button" class="btn btn-success btn-sm" onclick="tambahForm('formatif')">+</button>
                  @else
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.remove()">-</button>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
          <div class="mt-2">
            <label for="bobot_formatif">Bobot Formatif (%)</label>
            <input type="number" name="bobot_formatif" class="form-control" placeholder="Bobot formatif" value="{{ $nilai->bobot_formatif }}" min="0" max="100">
          </div>
        </div>

        @php
          $sumatif_cp = json_decode($nilai->sumatif_cp, true) ?? [];
          if (empty($sumatif_cp)) {
              $sumatif_cp = [['nilai' => '', 'keterangan' => '']];
          }
        @endphp


        @php
          $sumatif_cp = json_decode($nilai->sumatif_cp, true) ?? [];
          if (empty($sumatif_cp)) {
              $sumatif_cp = [['nilai' => '', 'keterangan' => '']];
          }
        @endphp

        {{-- Sumatif CP --}}
        <div class="form-group mb-3">
          <label>Nilai Sumatif CP</label>
          <div id="sumatif_cp-wrapper">
            @foreach($sumatif_cp as $i => $f)
              <div class="row mb-2">
                <div class="col"><input type="number" name="sumatif_cp[{{ $i }}][nilai]" class="form-control" placeholder="Nilai" value="{{ $f['nilai'] }}" min="0" max="100"></div>
                <div class="col"><input type="text" name="sumatif_cp[{{ $i }}][keterangan]" class="form-control" placeholder="Keterangan" value="{{ $f['keterangan'] }}"></div>
                <div class="col-auto">
                  @if ($i == 0)
                    <button type="button" class="btn btn-success btn-sm" onclick="tambahForm('sumatif_cp')">+</button>
                  @else
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.remove()">-</button>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
          <div class="mt-2">
            <label for="bobot_sumatif_cp">Bobot Sumatif CP (%)</label>
            <input type="number" name="bobot_sumatif_cp" class="form-control" placeholder="Bobot sumatif CP" value="{{ $nilai->bobot_sumatif_cp }}" min="0" max="100">
          </div>
        </div>

        @php
          $sumatif_semester = json_decode($nilai->sumatif_semester, true) ?? [];
          if (empty($sumatif_semester)) {
              $sumatif_semester = [['nilai' => '', 'keterangan' => '']];
          }
        @endphp

        {{-- Sumatif Semester --}}
        <div class="form-group mb-3">
          <label>Nilai Sumatif Semester</label>
          <div id="sumatif_semester-wrapper">
            @foreach($sumatif_semester as $i => $f)
              <div class="row mb-2">
                <div class="col"><input type="number" name="sumatif_semester[{{ $i }}][nilai]" class="form-control" placeholder="Nilai" value="{{ $f['nilai'] }}" min="0" max="100"></div>
                <div class="col"><input type="text" name="sumatif_semester[{{ $i }}][keterangan]" class="form-control" placeholder="Keterangan" value="{{ $f['keterangan'] }}"></div>
                <div class="col-auto">
                  @if ($i == 0)
                    <button type="button" class="btn btn-success btn-sm" onclick="tambahForm('sumatif_semester')">+</button>
                  @else
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.remove()">-</button>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
          <div class="mt-2">
            <label for="bobot_sumatif_semester">Bobot Sumatif Semester (%)</label>
            <input type="number" name="bobot_sumatif_semester" class="form-control" placeholder="Bobot sumatif semester" value="{{ $nilai->bobot_sumatif_semester }}" min="0" max="100">
          </div>
        </div>

        @php
          $tingkat_akhir = json_decode($nilai->tingkat_akhir, true) ?? [];
          if (empty($tingkat_akhir)) {
              $tingkat_akhir = [['nilai' => '', 'keterangan' => '']];
          }
        @endphp
        {{-- Tingkat Akhir --}}
        <div class="form-group mb-3">
          <label>Nilai Tingkat Akhir</label>
          <div id="tingkat_akhir-wrapper">
            @foreach($tingkat_akhir as $i => $f)
              <div class="row mb-2">
                <div class="col"><input type="number" name="tingkat_akhir[{{ $i }}][nilai]" class="form-control" placeholder="Nilai" value="{{ $f['nilai'] }}" min="0" max="100"></div>
                <div class="col"><input type="text" name="tingkat_akhir[{{ $i }}][keterangan]" class="form-control" placeholder="Keterangan" value="{{ $f['keterangan'] }}"></div>
                <div class="col-auto">
                  @if ($i == 0)
                    <button type="button" class="btn btn-success btn-sm" onclick="tambahForm('tingkat_akhir')">+</button>
                  @else
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.remove()">-</button>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
          <div class="mt-2">
            <label for="bobot_tingkat_akhir">Bobot Tingkat Akhir (%)</label>
            <input type="number" name="bobot_tingkat_akhir" class="form-control" placeholder="Bobot tingkat akhir" value="{{ $nilai->bobot_tingkat_akhir }}" min="0" max="100">
          </div>
        </div>

        <div class="form-group mb-3">
          <label>Evaluasi</label>
          <textarea name="evaluasi" class="form-control" rows="2" placeholder="Tulis evaluasi akhir siswa...">{{ $nilai->evaluasi }}</textarea>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <a href="{{ route('guru.nilai_akademik.index') }}" class="btn btn-light">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>

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
        type: 'POST',
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
