<?php
 
namespace App\Services;
use App\Interfaces\ContentRepositoryInterface;


class ContentService
{
    public function __construct(private ContentRepositoryInterface $repo) {}

    public function getContent()
    {
        return $this->repo->get_all_content();
    }
}