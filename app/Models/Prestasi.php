<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestasi extends Model
{
    use SoftDeletes;

    protected $table = 'prestasi';

    protected $fillable = [
        'id', 'lomba', 'tingkat', 'juara', 'tanggal',
        'dokumentasi', 'id_siswa',
        'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
