<?php

namespace App\DTO;

class FAQDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $question,
        public readonly ?string $answer,
    ) {}

    public static function fromModel(\App\Models\FAQ $faq): self
    {
        return new self(
            id: $faq->id,
            question: $faq->question,
            answer: $faq->answer,
        );
    }
}
