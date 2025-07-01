<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Masukkan data pengguna</p>

    <form class="forms-sample" id="formTambahPengguna" action="{{ route('pengguna.store') }}" method="POST" onsubmit="return confirm('Yakin kirim?')">
      @csrf
      <div class="row">
        <div class="form-group mb-3">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" required>
        </div>

        <div class="form-group mb-3">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" required>
        </div>

        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="form-group mb-3">
          <label for="role_id">Role</label>
          <select name="role_id" id="role_id" class="form-control select2" style="color: black; background-color: white;" required onchange="handleRoleChange()">
            <option value="">-- Pilih Role --</option>
            @foreach($role as $item)
              <option value="{{ $item->id }}" data-name="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_guru">Nama Guru</label>
          <select name="id_guru" id="id_guru" class="form-control select2" style="color: black; background-color: white;">
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $item)
              <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2" style="color: black; background-color: white;">
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option value="{{ $item->id }}" data-nisn="{{ $item->nisn }}">{{ $item->nama }} - {{ $item->nisn }}</option>
            @endforeach
          </select>
        </div>

        <div class="text-end mt-4">
          <button type="submit" class="btn btn-primary text-white">Simpan</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function handleRoleChange() {
    const roleId = document.getElementById("role_id").value;
    const guruSelect = document.getElementById("id_guru");
    const siswaSelect = document.getElementById("id_siswa");

    // Aktifkan semua dulu
    guruSelect.disabled = false;
    siswaSelect.disabled = false;

    if (roleId == 1) { // Admin
      guruSelect.disabled = true;
      siswaSelect.disabled = true;
      guruSelect.value = "";
      siswaSelect.value = "";
    } else if (roleId == 2) { // Guru
      siswaSelect.disabled = true;
      siswaSelect.value = "";
    } else if (roleId == 3) { // Orang Tua
      guruSelect.disabled = true;
      guruSelect.value = "";
    }
  }

  // Jalankan saat halaman pertama kali dibuka
  document.addEventListener("DOMContentLoaded", function () {
    handleRoleChange();
  });
</script>
