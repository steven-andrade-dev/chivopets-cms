<?php

namespace App\Repositories;

use App\Interfaces\FAQRepositoryInterface;
use App\Models\FAQ;
use App\DTO\FAQDTO;
use Illuminate\Http\Request;

class FAQRepository implements FAQRepositoryInterface
{
    public function get_all_faq(Request $request, $page)
    {
        return FAQ::where('id_locale', $request->idLanguage)->paginate($page);
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

    public function delete_faq($id)
    {
        $faq = FAQ::where('id', $id)->first();
        if ($faq) {
            $faq->delete();
        }
        return true;
    }

    public function update_faq_status($status,$id)
    {
        $faq = FAQ::findOrFail($id);

        if ($faq->parent) {
            $faq->fill($faq->parent->only(["question" ,"answer"]));
            $faq->parent->delete();
        }

        $faq->faq_id_parent = null;
        $faq->status = $status;
        $faq->save();

        return $faq;
    }
}
