<?php

namespace App\Interfaces;

interface SubmainRepositoryInterface
{
    public function get_all_submain();
    public function get_submain_by_id($id);
    public function create_submain(array $data);
    public function update_submain($id, array $data);
    public function delete_submain($id);
}