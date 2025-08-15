<?php

namespace App\Repositories;

use App\Interfaces\ContentCarrouselRepositoryInterface;
use App\Models\ContentCarrousel;

class ContentCarrouselRepository implements ContentCarrouselRepositoryInterface
{
    public function save_content_carrousel($validated)
    {
        $content_faq = ContentCarrousel::create($validated);
        return $content_faq;
    }

    public function delete_content_faq($id)
    {
        $content_faq = ContentFAQ::where('id', $id)->first();
        
        if ($content_faq) {
            $content_faq->delete();
            return true;
        }
        
        return false;
    }
}
