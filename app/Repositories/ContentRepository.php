<?php

namespace App\Repositories;

use App\Interfaces\ContentRepositoryInterface;
use App\Models\Content; 
use App\DTO\ContentDTO;
use App\Models\CarruselItem;
use App\Models\ContentCarousel;

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
        $content = Content::with(['contentCarousel.carruselItem', 'contentFAQs.faq'])->find($id);
       
        return $content ? ContentDTO::fromModel($content) : null;
        //return $content;
    }

    public function update_content($validated)
    {
        $content = Content::findorFail($validated['id']);
        $content->update($validated);
        
        return $content;
    }
}
