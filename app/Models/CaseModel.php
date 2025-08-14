<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class CaseModel extends Model
{
    use LogsActions;

    protected $table = 'case';
    protected $fillable = [
        'image', 'image_author', 'author', 'area', 'name', 'introduction',
         'text_button', 'created_at', 'updated_at', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'
    ];


    public function locale()
    {
        return $this->belongsTo(Locale::class, 'id_locale');
    }

    public function descriptionCases()
    {
        return $this->hasMany(DescriptionCase::class, 'id_case');
    }
    

}
