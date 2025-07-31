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

    public function get_Main_with_locale()
    {
        return Main::with('locale')->get();
    }

     public function get_main_by_id($id)
    {
        return Main::find($id);
    }
    
        public function create_main(array $data)
    {
        return Main::create($data);
    }

    public function update_main($id, array $data)
    {
        $main = Main::findOrFail($id);
        $main->update($data);
        return $main;
    }

    public function delete_main($id)
    {
        $main = Main::findOrFail($id);
        $main->delete();
        return true;
    }
}
