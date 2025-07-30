<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User; 

class UserRepository implements UserRepositoryInterface
{
    public function get_all_user()
    {
        return User::all();
    }

    public function get_user_by_id($id)
    {
        return User::find($id);
    }

    public function create_user(array $data)
    {
        return User::create($data);
    }

    public function update_user($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return true;
    }

}
