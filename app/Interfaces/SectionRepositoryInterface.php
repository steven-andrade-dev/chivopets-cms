<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface SectionRepositoryInterface
{
    public function get_all_section(Request $request, $page);
    public function get_section_by_id($id);
    public function update_section($id, array $data);
    public function update_section_publish($id);
}
