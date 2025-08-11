<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Submenu extends Model
{

    use LogsActions;

    protected $table = 'submenus';
    protected $fillable = ['id_menu', 'name', 'url', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
    public function locale()
    {
        return $this->belongsTo(Locale::class, 'id_locale');
    }
}
