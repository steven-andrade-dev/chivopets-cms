<?php

namespace App\Interfaces;

interface DescriptionCasesRepositoryInterface
{
    public function get_all_description_cases();
    public function get_description_case_by_id(int $id);
    public function create_description_case(array $data);
    public function update_description_case(int $id, array $data);
    public function delete_description_case(int $id);
    public function reorder(array $orders);}
