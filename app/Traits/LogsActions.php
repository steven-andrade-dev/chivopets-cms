<?php

namespace App\Traits;

use App\Models\ActionLog;
use Illuminate\Support\Facades\Auth;

trait LogsActions
{
    public static function bootLogsActions()
    {
        static::created(function ($model) {
            self::logAction($model, 'Creación', $model->getAttributes());
        });

        static::updated(function ($model) {
            self::logAction($model, 'Actualización', $model->getChanges());
        });

        static::deleted(function ($model) {
            self::logAction($model, 'Eliminado', $model->getOriginal());
        });
    }

    protected static function logAction($model, $action, $changes)
    {
        $userId = Auth::check() ? Auth::user()->id : null;
        ActionLog::create([
            'model'    => class_basename($model),
            'model_id' => $model->getKey(),
            'action'   => $action,
            'changes'  => $changes,
            'user_id'  => $userId
        ]);
    }
}
