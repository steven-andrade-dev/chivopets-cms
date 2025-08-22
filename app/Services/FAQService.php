<?php

namespace App\Services;
use App\Interfaces\FAQRepositoryInterface;
use Illuminate\Http\Request;

class FAQService
{
    public function __construct(private FAQRepositoryInterface $repo) {}

    public function get_all_faq(Request $request, $page)
    {
        return $this->repo->get_all_faq($request, $page);
    }

    public function get_faq_by_id($id)
    {
        return $this->repo->get_faq_by_id($id);
    }

    public function update_faq($request, $id)
    {
        return $this->repo->update_faq($request, $id);
    }

    public function create_faq($request)
    {
        return $this->repo->create_faq($request);
    }

    public function delete_faq($id)
    {
        return $this->repo->delete_faq($id);
    }

    public function updateFAQStatus($status,$id)
    {
        return $this->repo->update_faq_status($status,$id);
    }
}
