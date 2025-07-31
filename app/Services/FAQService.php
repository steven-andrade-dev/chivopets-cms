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

     

}