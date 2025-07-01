<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['nama', 'jumlah_penilaian', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
