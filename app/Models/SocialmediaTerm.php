<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class SocialmediaTerm extends Model
{
    use LogsActions;

    protected $table = 'socialmedia_terms';
    protected $fillable = ['name', 'url', 'icon', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];
}
