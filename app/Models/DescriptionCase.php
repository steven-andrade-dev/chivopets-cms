<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class DescriptionCase extends Model
{
    use LogsActions;

    protected $table = 'description_case';
    protected $fillable = ['description', 'etiqueta','created_at','updated_at','published_at','created_by_id', 'updated_by_id', 'id_locale', 'id_case'];

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'id_locale');
    }

    public function caseModel()
    {
        return $this->belongsTo(CaseModel::class, 'id_case');
    }

}


