<?php

namespace App\Interfaces;

interface CasesRepositoryInterface
{
    public function get_all_cases();
    public function get_case_by_id(int $id);
    public function create_case(array $data);
    public function update_case(int $id, array $data);
    public function delete_case(int $id);
}
