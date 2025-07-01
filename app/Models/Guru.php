<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['nip', 'nama', 'bidang_ajar', 'jabatan', 'kontak', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];
    
    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
