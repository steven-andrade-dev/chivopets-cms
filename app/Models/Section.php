<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Section extends Model
{
    use LogsActions;

    // protected $table = 'section';
    protected $fillable = ['name', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'id_section');
    }
}
