<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class TipsModel extends Model
{
    use LogsActions;

    protected $table = 'tips';
    protected $fillable = [
        'image', 'image_author', 'author', 'area', 'name', 'introduction',
         'text_button', 'created_at', 'updated_at', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'
    ];


    public function locale()
    {
        return $this->belongsTo(Locale::class, 'id_locale');
    }

    public function descriptionTips()
    {
        return $this->hasMany(DescriptionTips::class, 'id_tips');
    }
    

}
