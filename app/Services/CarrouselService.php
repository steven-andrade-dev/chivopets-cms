<?php

namespace App\Services;
use App\Interfaces\CarrouselRepositoryInterface;

class CarrouselService
{
    public function __construct(public CarrouselRepositoryInterface $repo) {}
    
    public function save_carrousel($validated)
    {
        return $this->repo->save_carrousel($validated);
    }
    public function delete_carrousel($id)
    {
        return $this->repo->delete_carrousel($id);
    }
}