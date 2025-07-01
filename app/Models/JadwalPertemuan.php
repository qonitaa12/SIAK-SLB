<?php

// app/Models/JadwalPertemuan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalPertemuan extends Model
{
    use SoftDeletes;

    protected $table = 'jadwal_pertemuan';

    protected $fillable = [
        'tanggal', 'waktu', 'tempat', 'status', 'id_orangtua', 'id_wali', 'id_guru',
        'created_by', 'updated_by', 'deleted_by'
    ];

    protected $dates = ['deleted_at'];

    public function orangtua()
    {
        return $this->belongsTo(OrangTua::class, 'id_orangtua');
    }

    public function wali()
    {
        return $this->belongsTo(Wali::class, 'id_wali');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}