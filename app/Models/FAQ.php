<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class FAQ extends Model
{
    use LogsActions;

    protected $table = 'FAQs';
    protected $fillable = [ 'question','faq_id_parent','status', 'answer', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'];

    public function contentFAQs()
    {
        return $this->hasMany(ContentFAQ::class, 'id_faq');
    }

    public function parent()
    {
        return $this->belongsTo(FAQ::class, 'id', 'faq_id_parent');
    }
}
