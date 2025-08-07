<?php
 
namespace App\Services;
use App\Interfaces\FAQRepositoryInterface;


class FAQService
{
    public function __construct(private FAQRepositoryInterface $repo) {}

    public function get_all_faq()
    {
        return $this->repo->get_all_faq();
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

}