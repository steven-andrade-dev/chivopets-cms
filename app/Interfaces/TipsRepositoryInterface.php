<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface TipsRepositoryInterface
{
    public function get_all_tips(Request $request, $page);
    public function get_tips_by_id(int $id);
    public function create_tips(array $data);
    public function update_tips(int $id, array $data);
    public function delete_tips(int $id);
}
