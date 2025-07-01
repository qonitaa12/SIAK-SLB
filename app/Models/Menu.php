<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name', 'url', 'parent_id', 'is_active', 'created_at', 'updated_at', 'order_by', 'icon', 'role_id'
    ];

    // (Opsional) Relasi ke Role, jika ingin
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
