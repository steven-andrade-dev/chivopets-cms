<?php

namespace App\DTO;

class MenuDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $url,
        /** @var SubmenuDTO[] */
        public readonly array $submenus = [],
    ) {}

    public static function fromModel(\App\Models\Menu $menu): self
    {
        return new self(
            id: $menu->id,
            name: $menu->name,
            url: $menu->url,
            submenus: $menu->submenus->map(fn($sub) => SubmenuDTO::fromModel($sub))->all(),
        );
    }
}
