<?php

namespace App\Repositories;

use App\Interfaces\ContentRepositoryInterface;
use App\Models\Content;
use App\DTO\ContentDTO;
use App\Models\CarruselItem;
use App\Models\ContentCarousel;

class ContentRepository implements ContentRepositoryInterface
{
    public function get_all_content($id)
    {
        if($id){
            return Content::with('parent')->where('id_section', $id)->get()->map(fn($content) => ContentDTO::fromModel($content));
        }
        return Content::all()->map(fn($content) => ContentDTO::fromModel($content));
    }

    public function get_content_by_id($id)
    {
        $content = Content::with(['contentCarousel.carruselItem', 'contentFAQs.faq'])->find($id);

        return $content ? ContentDTO::fromModel($content) : null;
        //return $content;
    }

    public function update_content($id, array $data)
    {
        // $content = Content::findorFail($validated['id']);
        // $content->update($validated);

        $content = Content::findOrFail($id);

        if ($content->status == 'Creado' || $content->content_id_parent !== null) {
            $content->update($data);
        } else {

            $newcontent = $content->replicate();
            $newcontent->fill($data);
            $newcontent->save();

            $newcontent->content_id_parent = $content->id;
            $newcontent->status = 'Borrador';
            $newcontent->save();
        }

        return $content;
    }

    public function update_content_publish($id)
    {
        $content = Content::findOrFail($id);

        if ($content->parent) {
            $content->fill($content->parent->only(["title" ,"bloque_principal" ,"status" ,"bloque_secundario" ,"image" ,"subtitle" ,"url" ,"id_section" ,"type_carrusel"]));
            $content->parent->delete();
        }

        $content->content_id_parent = null;
        $content->status = 'Publicado';
        $content->save();

        return $content;
    }

    public function content_unpublish($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return $content;
    }
}
