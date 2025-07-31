<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function get_all_user();
    public function get_user_by_id($id);
    public function create_user(array $data);
    public function update_user($id, array $data);
    public function delete_user($id);
}