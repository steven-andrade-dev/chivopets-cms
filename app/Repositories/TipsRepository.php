<?php

namespace App\Repositories;

use App\Interfaces\TipsRepositoryInterface;
use App\Models\TipsModel;
use Illuminate\Http\Request;

class TipsRepository implements TipsRepositoryInterface
{
    public function get_all_tips(Request $request, $page)
    {
       $tips = TipsModel::where('id_locale', $request->idLanguage)->paginate($page);
       return $tips;
    }

    public function get_tips_by_id(int $id)
    {
        return TipsModel::with('descriptionTips')->find($id);
    }


    public function create_tips(array $data)
    {
        return TipsModel::create($data);
    }

    public function update_tips(int $id, array $data)
    {
        $tips = TipsModel::find($id);
        $tips->update($data);
        return $tips;
    }

    public function delete_tips(int $id)
    {
        $tips = TipsModel::find($id);
        $tips->delete();
        return $tips;
    }
}
