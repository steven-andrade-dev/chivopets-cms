<?php
 
namespace App\Services;
use App\Interfaces\ContentRepositoryInterface;


class ContentService
{
    public function __construct(private ContentRepositoryInterface $repo) {}

    public function getContent($id)
    {
        return $this->repo->get_all_content($id);
    }
    public function getContentById($id)
    {
        return $this->repo->get_content_by_id($id);
    }

    public function updateContent($validated)
    {
        return $this->repo->update_content($validated);
    }
}