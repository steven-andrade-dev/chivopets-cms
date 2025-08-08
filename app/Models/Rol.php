<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Rol extends Model
{
    use LogsActions;

    protected $table = 'rol';
    protected $fillable = ['name', 'published_at', 'created_by_id', 'updated_by_id'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}
