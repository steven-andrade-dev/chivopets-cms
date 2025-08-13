<?php

namespace App\Repositories;

use App\Interfaces\SectionRepositoryInterface;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionRepository implements SectionRepositoryInterface
{
    public function get_all_section(Request $request, $page)
    {
        return Section::where('id_locale', $request->idLanguage)->paginate($page);
    }

    public function get_section_by_id($id)
    {
        return Section::find($id);
    }
}
