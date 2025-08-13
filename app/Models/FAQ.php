<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class FAQ extends Model
{
    use LogsActions;

    protected $table = 'FAQs';
    protected $fillable = [ 'question', 'answer', 'published_at', 'created_by_id', 'updated_by_id', 'id_locale'];

    public function contentFAQs()
    {
        return $this->hasMany(ContentFAQ::class, 'id_faq');
    }
}
