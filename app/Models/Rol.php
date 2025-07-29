<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $fillable = ['name', 'published_at', 'created_by_id', 'updated_by_id'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}
