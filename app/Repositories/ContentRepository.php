<?php

namespace App\Repositories;

use App\Interfaces\ContentRepositoryInterface;
use App\Models\Content; 

class ContentRepository implements ContentRepositoryInterface
{
    public function get_all_content()
    {
        return Content::all();
    }

    public function get_content_by_id($id)
    {
        return Content::find($id);
    }
}
