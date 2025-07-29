<?php

namespace App\Repositories;

use App\Interfaces\SectionRepositoryInterface;
use App\Models\Section;
class SectionRepository implements SectionRepositoryInterface
{
    public function get_all_section()
    {
       $sectiones = Section::all();
       return $sectiones;
    }
    public function get_section_by_id($id)
    {
        return [
            'section1' => 'Section 3',
            'section2' => 'Section 2',
            'section3' => 'Section 3',
        ];
    }
}
