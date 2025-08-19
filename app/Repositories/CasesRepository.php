<?php

namespace App\Repositories;

use App\Interfaces\CasesRepositoryInterface;
use App\Models\CaseModel;
use Illuminate\Http\Request;

class CasesRepository implements CasesRepositoryInterface

{
    public function get_all_cases(Request $request, $page)
    {
       $cases = CaseModel::where('id_locale', $request->idLanguage)->paginate($page);
       return $cases;
    }

    public function get_case_by_id(int $id)
    {
        return CaseModel::with('descriptionCases')->find($id);
    }


    public function create_case(array $data)
    {
        return CaseModel::create($data);
    }

    public function update_case(int $id, array $data)
    {
        $case = CaseModel::find($id);
        $case->update($data);
        return $case;
    }

    public function delete_case(int $id)
    {
        $case = CaseModel::find($id);
        $case->delete();
        return $case;
    }
}
