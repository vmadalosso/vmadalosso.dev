<?php

declare(strict_types=1);

namespace App\Content;

final readonly class Book
{
    /**
     * @param string|array<string, string> $title string quando o título é igual nos dois idiomas
     * @param array<string, string>|null $note por que você recomenda (opcional)
     */
    public function __construct(
        public string|array $title,
        public string $author,
        public Shelf $shelf,
        public ?array $note = null,
    ) {}
}
