<?php

namespace App\Interfaces;

interface RolRepositoryInterface
{
    public function get_all_rol();
    public function get_rol_by_id($id);
    public function create_rol(array $data);
    public function update_rol($id, array $data);
    public function delete_rol($id);
}