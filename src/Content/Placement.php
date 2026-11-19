<?php

declare(strict_types=1);

namespace App\Content;

/** Onde o projeto aparece na home. */
enum Placement: string
{
    /** Grade principal (2×2). */
    case Featured = 'featured';

    /** Card "Construindo agora". */
    case Now = 'now';

    /** Lista compacta "Outros projetos". */
    case Other = 'other';
}
