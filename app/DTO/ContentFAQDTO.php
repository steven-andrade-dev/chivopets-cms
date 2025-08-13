<?php

namespace App\DTO;

class ContentFAQDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $question,
        public readonly ?string $answer,
        public readonly ?int $id_locale,
    ) {}

    public static function fromModel(\App\Models\FAQ $content): self
    {
        return new self(
            id: $content->id_content ?? $content->id ?? 0,
            question: $content->question,
            answer: $content->answer,
            id_locale: $content->id_locale,
        );
    }
}
