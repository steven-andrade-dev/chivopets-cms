<?php

namespace App\Repositories;

use App\Interfaces\ContentRepositoryInterface;
use App\Models\Content; 
use App\DTO\ContentDTO;
class ContentRepository implements ContentRepositoryInterface
{
    public function get_all_content($id)
    {
        if($id){
            return Content::where('id_section', $id)->get()->map(fn($content) => ContentDTO::fromModel($content));
        }
        return Content::all()->map(fn($content) => ContentDTO::fromModel($content));
    }

    public function get_content_by_id($id)
    {
        return Content::find($id);
    }
}
