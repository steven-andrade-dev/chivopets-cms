<?php

namespace App\Repositories;
use App\Interfaces\SubmainRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\Submain; 

class SubmainRepository implements SubmainRepositoryInterface
{
    public function get_all_submain()
    {
        return Submain::all();
    }

    public function get_submain_by_id($id)
    {
        return Submain::find($id);
    }

    public function create_submain(array $data)
    {
        return Submain::create($data);
    }

    public function update_submain($id, array $data)
    {

        $submain = Submain::findOrFail($id);
        $submain->update($data);
        return $submain;
    }

    public function delete_submain($id)
    {
        $submain = Submain::findOrFail($id);
        $submain->delete();
        return true;
    }

}
