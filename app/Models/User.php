<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = ['name', 'lastname', 'id_rol', 'published_at', 'created_by_id', 'updated_by_id'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}

