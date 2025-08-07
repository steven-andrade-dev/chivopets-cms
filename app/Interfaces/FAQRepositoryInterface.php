<?php

namespace App\Interfaces;

interface FAQRepositoryInterface
{
    public function get_all_faq();
    public function get_faq_by_id($id);
    public function update_faq($request, $id);
    public function create_faq($request);
}