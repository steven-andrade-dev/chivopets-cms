<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialmediaTerm extends Model
{
    protected $table = 'socialmedia_terms';
    protected $primaryKey = 'id_submain';
    protected $fillable = ['name', 'url', 'icon', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];
}
