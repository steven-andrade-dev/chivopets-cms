<?php

namespace App\Interfaces;

interface SubmenuRepositoryInterface
{
    public function get_all_submenu($id);
    public function get_submenu_by_id($id);
    public function create_submenu(array $data);
    public function update_submenu($id, array $data);
    public function delete_submenu($id);
}