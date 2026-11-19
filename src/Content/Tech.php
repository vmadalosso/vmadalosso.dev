<?php

declare(strict_types=1);

namespace App\Content;

final readonly class Tech
{
    public function __construct(
        public string $name,
        /** Nome do arquivo em resources/icons, sem o .svg. */
        public string $icon,
    ) {}
}
