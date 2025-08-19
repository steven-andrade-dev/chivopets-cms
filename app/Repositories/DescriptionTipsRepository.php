<?php

namespace App\Repositories;

use App\Interfaces\DescriptionTipsRepositoryInterface;
use App\Models\DescriptionTips;

class DescriptionTipsRepository implements DescriptionTipsRepositoryInterface
{
    public function get_all_description_tips()
    {
       $tips = DescriptionTips::all();
       return $tips;
    }

    public function get_description_tips_by_id(int $id)
    {
        return DescriptionTips::with('descriptionTips')->find($id);
    }


    public function create_description_tips(array $data)
    {
        return DescriptionTips::create($data);
    }

    public function update_description_tips(int $id, array $data)
    {
        $tips = DescriptionTips::find($id);
        $tips->update($data);
        return $tips;
    }

    public function delete_description_tips(int $id)
    {
        $tips = DescriptionTips::find($id);
        $tips->delete();
        return $tips;
    }

        public function reorder(array $orders)
    {
        foreach ($orders as $row) {
            if (!isset($row['id'], $row['order'])) {
                continue;
            }

            $tips = DescriptionTips::find($row['id']);
            if ($tips) {
                $tips->update(['order' => (int) $row['order']]);
            }
        }

        return true;
    }


}
