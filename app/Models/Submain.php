<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submain extends Model
{
    protected $table = 'submains';
    protected $fillable = ['id_main', 'name', 'url', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];

    public function main()
    {
        return $this->belongsTo(Main::class, 'id_main');
    }
}
