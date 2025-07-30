<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'id_rol', 'published_at', 'created_by_id', 'updated_by_id'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}

