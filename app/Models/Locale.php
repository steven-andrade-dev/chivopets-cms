<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $table = 'locals';
    protected $fillable = ['name', 'code', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'id_locale');
    }

    public function mains()
    {
        return $this->hasMany(Main::class, 'id_locale');
    }
}
