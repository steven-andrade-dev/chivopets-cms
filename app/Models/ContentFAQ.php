<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentFAQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_content', 'id_faq'
    ];

    public function faq()
    {
        return $this->belongsTo(FAQ::class, 'id_carousel');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }
}
