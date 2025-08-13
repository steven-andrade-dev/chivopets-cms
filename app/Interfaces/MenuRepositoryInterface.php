<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface MenuRepositoryInterface
{
    public function get_all_menu(Request $request);
    public function get_menu_with_locale();
    public function get_menu_by_id($id);
    public function create_menu(array $data);
    public function update_menu($id, array $data);
    public function delete_menu($id);
}
