<?php

namespace App\Repositories;

use App\Interfaces\DescriptionCasesRepositoryInterface;
use App\Models\DescriptionCase;
class DescriptionCasesRepository implements DescriptionCasesRepositoryInterface
{
    public function get_all_description_cases()
    {
       $cases = DescriptionCase::all();
       return $cases;
    }

    public function get_description_case_by_id(int $id)
    {
        return DescriptionCase::with('descriptionCases')->find($id);
    }


    public function create_description_case(array $data)
    {
        return DescriptionCase::create($data);
    }

    public function update_description_case(int $id, array $data)
    {
        $case = DescriptionCase::find($id);
        $case->update($data);
        return $case;
    }

    public function delete_description_case(int $id)
    {
        $case = DescriptionCase::find($id);
        $case->delete();
        return $case;
    }

        public function reorder(array $orders)
    {
        foreach ($orders as $row) {
            if (!isset($row['id'], $row['order'])) {
                continue;
            }

            $case = DescriptionCase::find($row['id']);
            if ($case) {
                $case->update(['order' => (int) $row['order']]);
            }
        }

        return true;
    }


}
