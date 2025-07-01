<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'username', 'nama', 'email', 'password', 'role_id', 'id_guru', 'id_siswa',
        'created_by', 'updated_by', 'deleted_by'
    ];

    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $hidden = ['password', 'remember_token'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
