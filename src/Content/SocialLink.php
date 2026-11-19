<?php

declare(strict_types=1);

namespace App\Content;

final readonly class SocialLink
{
    public function __construct(
        public string $label,
        public string $url,
        /** Nome do arquivo em resources/icons, sem o .svg. */
        public string $icon,
        /** false esconde o link sem apagá-lo (ex.: YouTube até sair o primeiro vídeo). */
        public bool $visible = true,
    ) {}
}
