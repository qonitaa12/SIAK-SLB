<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrangTua extends Model
{
    use SoftDeletes;

    protected $table = 'orang_tua';

    protected $fillable = [
        'id', 'nama_ayah', 'tahun_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah',
        'penghasilan_ayah', 'nik_ayah', 'nama_ibu', 'tahun_lahir_ibu', 'pendidikan_ibu',
        'pekerjaan_ibu', 'penghasilan_ibu', 'nik_ibu', 'id_siswa',
        'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
