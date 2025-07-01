<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $table = 'siswa';

    protected $fillable = [
        'nama', 'nipd', 'nisn', 'gender', 'tempat_lahir', 'tanggal_lahir', 'nik',
        'agama', 'alamat', 'jenis_tinggal', 'alat_transportasi', 'no_hp', 'kebutuhan_khusus',
        'anak_ke', 'jarak_rumah', 'penerima_kps', 'no_kps', 'penerima_kip', 'no_kip',
        'nama_kip', 'no_kks', 'layak_kip', 'alasan_layak'
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function orangtua()
    {
        return $this->hasOne(OrangTua::class, 'id_siswa');
    }

    public function kelassiswa()
    {
        return $this->hasOne(kelassiswa::class, 'id_siswa');
    }

    public function wali()
    {
        return $this->hasOne(Wali::class, 'id_siswa');
    }
}
