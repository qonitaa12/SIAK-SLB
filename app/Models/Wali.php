<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wali extends Model
{
    use SoftDeletes;

    protected $table = 'wali';

    protected $fillable = [
        'id', 'nama_wali', 'tahun_lahir_wali', 'pendidikan_wali', 'pekerjaan_wali',
        'penghasilan_wali', 'nik_wali', 'id_siswa',
        'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
