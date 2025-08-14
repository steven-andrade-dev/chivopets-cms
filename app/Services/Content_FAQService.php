<?php
 
namespace App\Services;
use App\Interfaces\Content_FAQRepositoryInterface;


class Content_FAQService
{
    public function __construct(private Content_FAQRepositoryInterface $repo) {}

   public function saveContent_FAQ($validated)
   {
    return $this->repo->save_content_faq($validated);
   }

   public function deleteContent_FAQ($id)
   {
    return $this->repo->delete_content_faq($id);
   }
}