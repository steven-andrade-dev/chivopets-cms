<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Content extends Model
{
    use LogsActions;

    protected $table = 'contents';
    protected $fillable = [
        'title', 'bloque_principal','bloque_secundario', 'image', 'subtitle', 'url', 'id_section',
        'type_carrusel', // 1- dinamico 2- estatico
        'published_at', 'created_by_id', 'updated_by_id', 'id_locale'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'id_section');
    }

    public function contentFAQs()
    {
        return $this->hasMany(ContentFAQ::class, 'id_content');
    }

    public function contentCarousel()
    {
        return $this->hasMany(ContentCarousel::class, 'id_content');
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'id_locale');
    }
}
