<?php

namespace App\Services;
use App\Interfaces\SectionRepositoryInterface;


class SectionService
{
    public function __construct(private SectionRepositoryInterface $repo) {}

    public function getSections()
    {
        return $this->repo->get_all_sections();
    }
}