<?php

namespace App\Repositories;
use App\Interfaces\SubmenuRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Submenu; 

class SubmenuRepository implements SubmenuRepositoryInterface
{
    public function get_all_submenu()
    {
        return Submenu::all();
    }

    public function get_submenu_by_id($id)
    {
        return Submenu::find($id);
    }

    public function create_submenu(array $data)
    {
        return Submenu::create($data);
    }

    public function update_submenu($id, array $data)
    {

        $submenu = Submenu::findOrFail($id);
        $submenu->update($data);
        return $submenu;
    }

    public function delete_submenu($id)
    {
        $submenu = Submenu::findOrFail($id);
        $submenu->delete();
        return true;
    }

}
