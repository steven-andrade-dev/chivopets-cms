<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarruselItem extends Model
{
    protected $table = 'carrusel_item';
    protected $fillable = [
        'id_content', 'title', 'subtitle', 'image', 'href', 'introduction', 'description', 'value',
        'title_info_aditional', 'published_at', 'created_by_id', 'updated_by_id', 'locale'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }
}
