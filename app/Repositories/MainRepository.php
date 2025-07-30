<?php

namespace App\Repositories;

use App\Interfaces\MainRepositoryInterface;
use App\Models\Main;
use App\DTO\MainDTO;

class MainRepository implements MainRepositoryInterface
{
    public function get_all_main()
    {
        return Main::with('submains')->get()->map(fn($main) => MainDTO::fromModel($main));
    }
}
