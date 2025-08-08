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
        'date', 'text_button', 'published_at', 'created_by_id', 'updated_by_id', 'locale'
    ];

    public function description()
    {
        return $this->hasMany(DescriptionCase::class, 'id', 'id_descrition');
    }
}
