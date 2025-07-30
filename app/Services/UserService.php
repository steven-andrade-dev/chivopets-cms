<?php
 
namespace App\Services;
use App\Interfaces\UserRepositoryInterface;


class UserService
{
    public function __construct(private UserRepositoryInterface $repo) {}

    public function getUser()
    {
        return $this->repo->get_all_user();
    }

      public function createUser(array $data)
    {
        return $this->repo->create_user($data);
    }

    public function updateUser($id, array $data)
    {
        return $this->repo->update_user($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->repo->delete_user($id);
    }

}