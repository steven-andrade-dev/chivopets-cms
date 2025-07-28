<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $table = 'main';
    protected $primaryKey = 'id_main';
    protected $fillable = ['name', 'url', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];

    public function submains()
    {
        return $this->hasMany(Submain::class, 'id_main');
    }
}
