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

    public function updateContent($id, $data)
    {
        return $this->repo->update_content($id, $data);
    }

    public function updateContentStatus($status,$id)
    {
        return $this->repo->update_content_status($status,$id);
    }

    public function contentUnPublish($id)
    {
        return $this->repo->content_unpublish($id);
    }
}
