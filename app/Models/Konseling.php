<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Konseling extends Model
{
    use SoftDeletes;

    protected $table = 'konseling';

    protected $fillable = [
        'id', 'tanggal', 'kesehatan', 'catatan', 'id_siswa', 'id_guru',
        'created_by', 'updated_by', 'deleted_by', 
        'created_at', 'updated_at', 'deleted_at'
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
 
}
