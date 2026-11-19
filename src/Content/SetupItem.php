<?php

declare(strict_types=1);

namespace App\Content;

final readonly class SetupItem
{
    /** @param array<string, string> $detail o que é (ex.: ['pt' => 'Teclado', 'en' => 'Keyboard']) */
    public function __construct(
        public string $name,
        public SetupCategory $category,
        public array $detail,
    ) {}
}
