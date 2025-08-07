<?php

namespace App\DTO;

class SubmenuDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $url,
    ) {}

    public static function fromModel(\App\Models\Submenu $submenu): self
    {
        return new self(
            id: $submenu->id,
            name: $submenu->name,
            url: $submenu->url,
        );
    }
}
