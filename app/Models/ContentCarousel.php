<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class ContentCarousel extends Model
{
    use LogsActions;

    public $timestamps = false;

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
