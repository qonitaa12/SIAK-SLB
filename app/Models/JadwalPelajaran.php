<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;



class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';
    protected $fillable = ['hari', 'jam_mulai', 'jam_selesai', 'id_kelas', 'id_mapel', 'id_guru',
    'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
