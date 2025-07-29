<?php

namespace App\Repositories;

use App\Interfaces\SectionRepositoryInterface;
use App\Models\Section;  // Importar el modelo

class SectionRepository implements SectionRepositoryInterface
{
    public function get_all_sections()
    {
        return Section::all();
    }

    public function get_all_section()
    {
        return Section::all();
    }

    public function get_section_by_id($id)
    {
        return Section::find($id);
    }
}
