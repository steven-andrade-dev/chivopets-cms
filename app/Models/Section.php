<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Section extends Model
{
    use LogsActions;

    // protected $table = 'section';
    protected $fillable = ['name', 'status', 'published_at','section_id_parent', 'created_by_id', 'updated_by_id', 'locale'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'id_section');
    }

    public function parent()
    {
        return $this->belongsTo(Section::class, 'id', 'section_id_parent');
    }
}
