<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiAkademik extends Model
{
    use SoftDeletes;

    protected $table = 'nilai_akademik';

    protected $fillable = [
        'id',
        'id_guru_mapel',
        'id_kelas_siswa',
        'formatif',
        'sumatif_cp',
        'sumatif_semester',
        'tingkat_akhir',
        'bobot_formatif',
        'bobot_sumatif_cp',
        'bobot_sumatif_semester',
        'bobot_tingkat_akhir', // <- sudah diperbaiki
        'rata_formatif',
        'rata_sumatif_cp',
        'rata_sumatif_semester',
        'rata_tingkat_akhir',
        'rata_total',
        'evaluasi',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'formatif' => 'array',
        'sumatif_cp' => 'array',
        'sumatif_semester' => 'array',
        // 'tingkat_akhir' bukan array
    ];

    protected $dates = ['deleted_at'];

    public function guruMapel()
    {
        return $this->belongsTo(GuruMapel::class, 'id_guru_mapel');
    }

    public function kelasSiswa()
    {
        return $this->belongsTo(KelasSiswa::class, 'id_kelas_siswa');
    }
}
