<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActions;

class Indice extends Model
{
    use LogsActions;

    protected $table = 'indice';
    protected $fillable = [
        'document_id', 'action', 'model', 'id_entry',
        'data_before', 'data_after', 'published_at', 'created_by_id', 'updated_by_id', 'locale'
    ];

    protected $casts = [
        'data_before' => 'array',
        'data_after' => 'array'
    ];
}
