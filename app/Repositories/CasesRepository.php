<?php

namespace App\Repositories;

use App\Interfaces\CasesRepositoryInterface;
use App\Models\CaseModel;
class CasesRepository implements CasesRepositoryInterface
{
    public function get_all_cases()
    {
       $cases = CaseModel::all();
       return $cases;
    }
   
}
