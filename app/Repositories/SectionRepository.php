<?php

namespace App\Repositories;

use App\Interfaces\SectionRepositoryInterface;

class SectionRepository implements SectionRepositoryInterface
{
    public function get_all_sections()
    {
        return [
            'section1' => 'Section 3',
            'section2' => 'Section 2',
            'section3' => 'Section 3',
        ];
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