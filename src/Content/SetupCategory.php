<?php

declare(strict_types=1);

namespace App\Content;

/** A ordem dos cases é a ordem das colunas na página. */
enum SetupCategory: string
{
    case Hardware = 'hardware';
    case Software = 'software';
}
