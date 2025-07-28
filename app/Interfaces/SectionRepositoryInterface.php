<?php

namespace App\Interfaces;

interface SectionRepositoryInterface
{
    public function get_all_sections();
    public function get_section_by_id($id);
}