<?php

namespace App\Repositories;

use App\Interfaces\LogRepositoryInterface;
use App\Models\ActionLog;
class LogRepository implements LogRepositoryInterface
{
    public function get_all_log($page)
    {
       $logs = ActionLog::with('user:id,name')->paginate($page);
       return $logs;
    }

}
