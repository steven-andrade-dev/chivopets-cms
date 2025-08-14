<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class ContentFAQ extends Model
{
    use HasFactory, LogsActions;
    public $timestamps = false;
    protected $fillable = [
        'id_content', 'id_faq'
    ];

    public function faq()
    {
        return $this->belongsTo(FAQ::class, 'id_faq');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'id_content');
    }
}
