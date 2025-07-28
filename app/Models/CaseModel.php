<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{
    protected $table = 'case';
    protected $primaryKey = 'id_case';
    protected $fillable = [
        'image', 'image_author', 'author', 'area', 'name', 'introduction', 'id_description',
        'date', 'text_button', 'published_at', 'created_by_id', 'updated_by_id', 'locale'
    ];

    public function description()
    {
        return $this->belongsTo(DescriptionCase::class, 'id_description', 'id_descrition');
    }
}