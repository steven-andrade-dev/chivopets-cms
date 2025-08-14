<?php

namespace App\Interfaces;

interface Content_FAQRepositoryInterface
{
  public function save_content_faq($validated);
  public function delete_content_faq($id);
}