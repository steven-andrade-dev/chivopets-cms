<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentCarousel extends Model
{
   
    protected $fillable = [
        'id_content', 'id_carousel'
    ];

    public function carruselItem()
    {
        return $this->belongsTo(CarruselItem::class, 'id_carousel');
    }
    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }
}
