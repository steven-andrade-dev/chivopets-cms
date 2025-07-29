<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptionCase extends Model
{
    protected $table = 'description_case';
    protected $fillable = ['description', 'etiqueta', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];
}
