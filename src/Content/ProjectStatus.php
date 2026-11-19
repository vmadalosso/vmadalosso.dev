<?php

declare(strict_types=1);

namespace App\Content;

/** Situação do projeto, mostrada com uma bolinha colorida no card. */
enum ProjectStatus: string
{
    case Live = 'live';
    case Building = 'building';
    case PersonalUse = 'personal-use';
}
