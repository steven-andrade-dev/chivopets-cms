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
            return Content::where('id_section', $id)->get()->map(fn($content) => ContentDTO::fromModel($content));
        }
        return Content::all()->map(fn($content) => ContentDTO::fromModel($content));
    }

    public function get_content_by_id($id)
    {
        $content = Content::with('contentCarousel.carruselItem')->find($id);
        
        return $content ? ContentDTO::fromModel($content) : null;
        //return $content;
    }

    public function update_content($validated)
    {
        $content = Content::findorFail($validated['id']);
        //actualizar el carrusel
        $content->update($validated);
        
        $items = $validated['carruselItems'] ?? [];
        // Borrar CarruselItems que ya no llegan en el request
        $ids_en_request = collect($items)->pluck('id')->filter()->toArray();
        CarruselItem::whereNotIn('id', $ids_en_request)
            ->delete();
        
        foreach($items as $item){
            if (isset($item['id'])) {
                CarruselItem::where('id', $item['id'])
                ->update($item);
            } else {
                // Insertar nuevo
                $nuevo = new CarruselItem($item);
                $nuevo->save();
                $relation_carrusel = [
                    "id_content" => $content->id,
                    "id_carousel" => $nuevo->id
                ];
                $content_carousel = new ContentCarousel($relation_carrusel);
                $content_carousel->save();
            }
        }
        \DB::commit();
        return $content;
    }
}
