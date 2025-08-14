<?php

namespace App\Repositories;

use App\Interfaces\Content_FAQRepositoryInterface;
use App\Models\ContentFAQ;

class Content_FAQRepository implements Content_FAQRepositoryInterface
{
    public function save_content_faq($validated)
    {
        $content_faq = ContentFAQ::create($validated);
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
