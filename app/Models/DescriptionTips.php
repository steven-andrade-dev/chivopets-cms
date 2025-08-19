<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class DescriptionTips extends Model
{
    use LogsActions;

    protected $table = 'description_tips';
    protected $fillable = ['description', 'order' , 'created_at','updated_at','published_at','created_by_id', 'updated_by_id', 'id_locale', 'id_tips'];

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'id_locale');
    }

    public function tipsModel()
    {
        return $this->belongsTo(TipsModel::class, 'id_tips');
    }

}


