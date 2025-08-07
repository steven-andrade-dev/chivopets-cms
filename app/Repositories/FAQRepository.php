<?php

namespace App\Repositories;

use App\Interfaces\FAQRepositoryInterface;
use App\Models\FAQ; 
use App\DTO\FAQDTO;

class FAQRepository implements FAQRepositoryInterface
{
    public function get_all_faq()
    {
        return FAQ::all()->map(fn($faq) => FAQDTO::fromModel($faq));
    }

  
}
