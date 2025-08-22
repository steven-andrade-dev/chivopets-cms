<?php

namespace App\Interfaces;

interface ContentRepositoryInterface
{
    public function get_all_content($id);
    public function get_content_by_id($id);
    public function update_content($id, array $data);
    public function update_content_status($status, $id);
    public function content_unPublish($id);
}
