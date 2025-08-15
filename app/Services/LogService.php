<?php

namespace App\Services;
use App\Interfaces\LogRepositoryInterface;

class LogService
{
    public function __construct(private LogRepositoryInterface $repo) {}

    public function getAllLogPaginate($page)
    {
        return $this->repo->get_all_log($page);
    }
}
