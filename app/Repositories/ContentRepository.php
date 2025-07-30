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
        $content = Content::find($id);
        return $content ? ContentDTO::fromModel($content) : null;
    }

    public function update_content($validated)
    {
        $content = Content::find($validated['id']);
        $content->title = $validated['title'];
        $content->description = $validated['description'];
        $content->url = $validated['url'];
        $content->locale = $validated['locale'];
        $content->save();
        return $content;
    }
}
