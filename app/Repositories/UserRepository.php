<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
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
        $data['password'] = Hash::make($data['password']); 
        $data['id_rol'] = $data['id_rol'] ?? 1; 
        return User::create($data);
    }

    public function update_user($id, array $data)
    {
        $user = User::findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); 
        }

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
