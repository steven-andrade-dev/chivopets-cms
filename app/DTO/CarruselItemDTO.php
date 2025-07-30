<?php

namespace App\DTO;

class CarruselItemDTO
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $subtitle,
        public readonly ?string $image,
        public readonly ?string $href,
        public readonly ?string $introduction,
        public readonly ?string $description,
        public readonly ?string $value,
        public readonly ?string $title_info_adicional,
    ) {}

    public static function fromModel(\App\Models\CarruselItem $main): self
    {
        return new self(
            title: $main->title,
            subtitle: $main->subtitle,
            image: $main->image,
            href: $main->href,
            introduction: $main->introduction,
            description: $main->description,
            value: $main->value,
            title_info_adicional: $main->title_info_adicional,
        );
    }
}
