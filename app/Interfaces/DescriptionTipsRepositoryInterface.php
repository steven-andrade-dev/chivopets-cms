<?php

namespace App\Interfaces;

interface DescriptionTipsRepositoryInterface
{
    public function get_all_description_tips();
    public function get_description_tips_by_id(int $id);
    public function create_description_tips(array $data);
    public function update_description_tips(int $id, array $data);
    public function delete_description_tips(int $id);
    public function reorder(array $orders);
}
