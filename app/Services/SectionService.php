<?php

namespace App\Services;
use App\Interfaces\SectionRepositoryInterface;
use Illuminate\Http\Request;

class SectionService
{
    public function __construct(private SectionRepositoryInterface $repo) {}

    public function getSection(Request $request, $page)
    {
        return $this->repo->get_all_section($request, $page);
    }

    public function updateSection($id, array $data)
    {
        return $this->repo->update_section($id, $data);
    }

    public function updateSectionPublish($id)
    {
        return $this->repo->update_section_publish($id);
    }
}
