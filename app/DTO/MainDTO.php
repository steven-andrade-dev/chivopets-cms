<?php

namespace App\DTO;

class MainDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $url,
        /** @var SubmainDTO[] */
        public readonly array $submains = [],
    ) {}

    public static function fromModel(\App\Models\Main $main): self
    {
        return new self(
            id: $main->id,
            name: $main->name,
            url: $main->url,
            submains: $main->submains->map(fn($sub) => SubmainDTO::fromModel($sub))->all(),
        );
    }
}
