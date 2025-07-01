<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

   public function kelasSiswa()
    {
        return $this->hasMany(KelasSiswa::class, 'id_kelas')->whereNull('deleted_at');
    }


}
