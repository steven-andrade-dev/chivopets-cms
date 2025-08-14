<?php

namespace App\Interfaces;
use Illuminate\Http\Request;
 
interface CasesRepositoryInterface
{
    public function get_all_cases(Request $request, $page);
    public function get_case_by_id(int $id);
    public function create_case(array $data);
    public function update_case(int $id, array $data);
    public function delete_case(int $id);
}
