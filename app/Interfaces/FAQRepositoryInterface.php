<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface FAQRepositoryInterface
{
    public function get_all_faq(Request $request, $page);
    public function get_faq_by_id($id);
    public function update_faq($request, $id);
    public function create_faq($request);
    public function update_faq_status($status, $id);
    public function delete_faq($id);
}
