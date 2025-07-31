<?php

namespace App\DTO;

class CarruselItemDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $title,
        public readonly ?string $subtitle,
        public readonly ?string $image,
        public readonly ?string $href,
        public readonly ?string $introduction,
        public readonly ?string $description,
        public readonly ?string $value,
        public readonly ?string $title_info_aditional,
        public readonly ?string $id_locale,
    ) {}

    public static function fromModel(\App\Models\CarruselItem $main): self
    {
        return new self(
            id: $main->id,
            title: $main->title,
            subtitle: $main->subtitle,
            image: $main->image,
            href: $main->href,
            introduction: $main->introduction,
            description: $main->description,
            value: $main->value,
            title_info_aditional: $main->title_info_aditional,
            id_locale: $main->id_locale,
        );
    }
}
