<?php

namespace App\Interfaces;

interface ContentRepositoryInterface
{
    public function get_all_content();
    public function get_content_by_id($id);
}