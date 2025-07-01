<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruMapel extends Model
{
    use SoftDeletes;

    protected $table = 'guru_mapel';

    protected $fillable = [
        'id', 'tahun_ajaran', 'semester','id_guru', 'id_mapel', 'id_kelas',
        'created_by', 'updated_by', 'deleted_by', 
        'created_at', 'updated_at', 'deleted_at'
    ];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
