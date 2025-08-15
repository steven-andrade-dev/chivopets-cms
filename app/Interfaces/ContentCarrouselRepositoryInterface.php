<?php

namespace App\Interfaces;

interface ContentCarrouselRepositoryInterface
{
  public function save_content_carrousel($validated);
  public function delete_content_carrousel($id);
}