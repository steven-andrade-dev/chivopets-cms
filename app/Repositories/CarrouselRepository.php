<?php

namespace App\Repositories;

use App\Interfaces\CarrouselRepositoryInterface;
use App\Models\CarruselItem;
use App\Models\ContentCarousel;

class CarrouselRepository implements CarrouselRepositoryInterface
{
    public function save_carrousel($validated)
    {
       $carrousel = CarruselItem::create($validated->all());
       if ($carrousel) {
        $content_carrousel = ContentCarousel::create([
            'id_content'  => $validated['id_content'],
            'id_carousel' => $carrousel->id,
        ]);
       }
       return $carrousel;
    }
    public function delete_carrousel($id)
    {
        $carrousel = CarruselItem::find($id);
        $content_carrousel = ContentCarousel::where('id_carousel', $id)->first();
        if ($content_carrousel) {
            $content_carrousel->delete();
        }
        if ($carrousel) {
            $carrousel->delete();
        }
        return true;
    }
}
