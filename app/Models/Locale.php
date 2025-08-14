<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Locale extends Model
{
    use LogsActions;

    protected $table = 'locals';
    protected $fillable = ['name', 'code', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'id_locale');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_locale');
    }
    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'id_locale');
    }

    public function cases()
    {
        return $this->hasMany(CaseModel::class, 'id_locale');
    }
}
