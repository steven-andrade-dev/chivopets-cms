<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $primaryKey = 'id_content';
    protected $fillable = [
        'title', 'description', 'image', 'subtitle', 'url', 'id_section',
        'tipe_carrusel', 'published_at', 'created_by_id', 'updated_by_id', 'locale'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, 'id_section');
    }

    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'id_content');
    }

    public function carruselItems()  
    {
        return $this->hasMany(CarruselItem::class, 'id_content');
    }
}
