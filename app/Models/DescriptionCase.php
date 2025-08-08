<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class DescriptionCase extends Model
{
    use LogsActions;

    protected $table = 'description_case';
    protected $fillable = ['description', 'etiqueta', 'published_at', 'created_by_id','id_description', 'updated_by_id', 'locale'];
}
