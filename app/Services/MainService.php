<?php

namespace App\Services;
use App\Interfaces\MainRepositoryInterface;


class MainService
{
    public function __construct(private MainRepositoryInterface $repo) {}

    public function getMain()
    {
        return $this->repo->get_all_main();
    }
}
