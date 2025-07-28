<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'FAQ';
    protected $primaryKey = 'id_faq';
    protected $fillable = ['id_content', 'question', 'answer', 'published_at', 'created_by_id', 'updated_by_id', 'locale'];

    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }
}
