<?php
 
namespace App\Services;
use App\Interfaces\ContentCarrouselRepositoryInterface;


class ContentCarrouselService
{
    private function __construct(private ContentCarrouselRepositoryInterface $repo) {}
    
    public function create_carrousel($validated){
        return $this->repo->save_content_carrousel($validated);
    }
  
}