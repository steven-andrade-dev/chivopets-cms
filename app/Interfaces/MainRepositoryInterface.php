<?php

namespace App\Interfaces;

interface MainRepositoryInterface
{
    public function get_all_main();
    public function get_Main_with_locale();
    public function get_main_by_id($id);
    public function create_main(array $data);
    public function update_main($id, array $data);
    public function delete_main($id);
}
