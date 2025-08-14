<?php

namespace App\DTO;

class ContentDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $bloque_principal,
        public readonly ?string $bloque_secundario,
        public readonly ?string  $image,
        public readonly ?string $subtitle,
        public readonly ?string $url,
        public readonly ?int $id_section,
        public readonly ?int $type_carrusel,
        /** @var CarruselItemDTO[] */
        public readonly array $carruselItems = [],
        public readonly ?int $id_locale,
        /** @var ContentFAQDTO[] */
        public readonly array $faq = [],
    ) {}

    public static function fromModel(\App\Models\Content $content): self
    {

        return new self(
            id: $content->id_content ?? $content->id ?? 0,
            name: $content->title,
            bloque_principal: $content->bloque_principal,
            bloque_secundario: $content->bloque_secundario,
            image: $content->image,
            subtitle: $content->subtitle,
            url: $content->url,
            id_section: $content->id_section,
            type_carrusel: $content->type_carrusel ?? null,
            carruselItems: $content->contentCarousel->map(fn($item) => CarruselItemDTO::fromModel($item->carruselItem))->all(),
            faq: $content->contentFAQs->map(fn($item) => ContentFAQDTO::fromModel($item->faq, $item->id))->all(),
            id_locale: $content->id_locale,
        );
    }
}
