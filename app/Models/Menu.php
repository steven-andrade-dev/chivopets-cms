<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Menu extends Model
{
    use LogsActions;

    protected $table = 'menu';
    protected $fillable = ['name', 'url', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'];

    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'id_menu');
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class, 'id_locale');
    }
}
