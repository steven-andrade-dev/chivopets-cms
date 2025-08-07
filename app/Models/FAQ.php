<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'FAQs';
    protected $fillable = [ 'question', 'answer', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'];

   
}
