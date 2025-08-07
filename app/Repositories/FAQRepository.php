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

    public function get_faq_by_id($id)
    {
        return FAQ::where('id', $id)->get()->map(fn($faq) => FAQDTO::fromModel($faq));
    }

    public function update_faq($request, $id)
    {
        $faq = FAQ::where('id', $id)->first();
        $faq->update($request->all());
        return FAQDTO::fromModel($faq);
    }

    public function create_faq($request)
    {
        $faq = FAQ::create($request->all());
        return FAQDTO::fromModel($faq);
    }

}
