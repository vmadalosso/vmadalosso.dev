<?php

declare(strict_types=1);

namespace App\Content;

/** Prateleira de um livro. A ordem dos cases é a ordem das colunas na página. */
enum Shelf: string
{
    case Tech = 'tech';
    case Literature = 'literature';
}
