<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $table = 'locals';
    protected $primaryKey = 'id';
    protected $fillable = ['document_id', 'name', 'code', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];
}
