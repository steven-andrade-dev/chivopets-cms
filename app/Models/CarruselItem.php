<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class CarruselItem extends Model
{
    use LogsActions;

    protected $table = 'carrusel_items';
    protected $fillable = [
         'title', 'subtitle', 'image', 'href', 'introduction', 'description', 'value',
        'title_info_aditional', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'
    ];

    public function content()
    {
        return $this->belongsTo(ContentCarousel::class, 'id_carousel');
    }
}
