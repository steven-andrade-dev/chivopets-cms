<?php

namespace App\DTO;

class ContentFAQDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $id_relacion,
        public readonly ?string $question,
        public readonly ?string $answer,
        public readonly ?int $id_locale,
    ) {}

    public static function fromModel(\App\Models\FAQ $faq, $id_relacion): self
    {
        return new self(
            id_relacion: $id_relacion,
            id: $faq->id_content ?? $faq->id ?? 0,
            question: $faq->question,
            answer: $faq->answer,
            id_locale: $faq->id_locale,
        );
    }
}
