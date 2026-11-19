<?php

declare(strict_types=1);

use App\Content\Tech;

/*
 * Tecnologias com que você trabalha, agrupadas: front-end, back-end, dados e ferramentas.
 * O segundo valor é o ícone em resources/icons (logos do Simple Icons: https://simpleicons.org).
 * O React Native usa o logo do React, que é o símbolo oficial dele.
 */
return [
    new Tech('JavaScript', 'javascript'),
    new Tech('TypeScript', 'typescript'),
    new Tech('React', 'react'),
    new Tech('React Native', 'react'),
    new Tech('Next.js', 'nextdotjs'),
    new Tech('Tailwind CSS', 'tailwindcss'),

    new Tech('Node.js', 'nodedotjs'),
    new Tech('NestJS', 'nestjs'),
    new Tech('PHP', 'php'),
    new Tech('Laravel', 'laravel'),

    new Tech('Supabase', 'supabase'),
    new Tech('PostgreSQL', 'postgresql'),
    new Tech('Git', 'git'),
];
