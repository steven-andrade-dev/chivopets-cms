<?php

namespace App\DTO;

class ContentDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?string  $image,
        public readonly ?string $subtitle,
        public readonly ?string $url,
        public readonly ?int $id_section,
        public readonly ?int $type_carrusel,
        public readonly ?string $locale,
    ) {}

    public static function fromModel(\App\Models\Content $content): self
    {
        return new self(
            id: $content->id_content ?? $content->id ?? 0,
            name: $content->title,
            description: $content->description,
            image: $content->image,
            subtitle: $content->subtitle,
            url: $content->url,
            id_section: $content->id_section,
            type_carrusel: $content->type_carrusel ?? null,
            locale: $content->locale,
        );
    }
}
