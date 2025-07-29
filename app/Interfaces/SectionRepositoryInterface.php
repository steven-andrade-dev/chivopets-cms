<?php

namespace App\Interfaces;

interface SectionRepositoryInterface
{
    public function get_all_section();
    public function get_section_by_id($id);
}