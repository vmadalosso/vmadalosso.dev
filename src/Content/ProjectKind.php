<?php

declare(strict_types=1);

namespace App\Content;

/** Que tipo de projeto é. O rótulo de cada um fica em lang/*.php ("kind.volunteer" etc.). */
enum ProjectKind: string
{
    case Volunteer = 'volunteer';
    case Degree = 'degree';
    case Personal = 'personal';
    case Product = 'product';
    case Tool = 'tool';
    case Challenge = 'challenge';
}
