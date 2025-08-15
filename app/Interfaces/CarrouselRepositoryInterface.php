<?php

namespace App\Interfaces;

interface CarrouselRepositoryInterface
{
  public function save_carrousel($validated);
  public function delete_carrousel($id);
}