<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    // protected $table = 'section';
    protected $primaryKey = 'id_section';
    protected $fillable = ['name', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'id_section');
    }
}
