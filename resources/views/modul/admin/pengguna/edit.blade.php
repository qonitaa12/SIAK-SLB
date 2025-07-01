<div class="card">
  <div class="card-body">
    <p class="card-description text-muted">Edit data pengguna</p>

    <form class="forms-sample" id="formEditPengguna" action="{{ route('pengguna.update', $pengguna->id) }}" method="POST" onsubmit="return confirm('Yakin update data?')">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="form-group mb-3">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" value="{{ $pengguna->username }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" value="{{ $pengguna->nama }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" value="{{ $pengguna->email }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" value="{{ $pengguna->password }}" required>
        </div>

        <div class="form-group mb-3">
          <label for="role_id">Role</label>
          <select name="role_id" id="role_id" class="form-control select2" required onchange="handleRoleChange()">
            <option value="">-- Pilih Role --</option>
            @foreach($role as $item)
              <option value="{{ $item->id }}" {{ $pengguna->role_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_guru">Nama Guru</label>
          <select name="id_guru" id="id_guru" class="form-control select2">
            <option value="">-- Pilih Guru --</option>
            @foreach($guru as $item)
              <option value="{{ $item->id }}" {{ $pengguna->id_guru == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="id_siswa">Nama Siswa</label>
          <select name="id_siswa" id="id_siswa" class="form-control select2">
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswa as $item)
              <option 
                value="{{ $item->id }}" 
                data-nisn="{{ $item->nisn }}"
                {{ $pengguna->id_siswa == $item->id ? 'selected' : '' }}>
                {{ $item->nama }} - {{ $item->nisn }}
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

<script>
  function handleRoleChange() {
    const roleId = document.getElementById("role_id").value;
    const guruSelect = document.getElementById("id_guru");
    const siswaSelect = document.getElementById("id_siswa");

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

  document.addEventListener("DOMContentLoaded", function () {
    handleRoleChange(); // Jalankan saat halaman edit pertama kali dimuat
  });
</script>
