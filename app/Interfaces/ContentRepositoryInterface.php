<?php

namespace App\Interfaces;

interface ContentRepositoryInterface
{
    public function get_all_content($id);
    public function get_content_by_id($id);
}