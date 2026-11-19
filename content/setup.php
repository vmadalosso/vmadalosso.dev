<?php

declare(strict_types=1);

use App\Content\SetupCategory;
use App\Content\SetupItem;

// Seu setup: hardware e software do dia a dia.
return [
    new SetupItem('MacBook Pro M2', SetupCategory::Hardware, ['pt' => 'Notebook', 'en' => 'Laptop']),
    new SetupItem('BenQ GL2780', SetupCategory::Hardware, ['pt' => 'Monitor', 'en' => 'Monitor']),
    new SetupItem('TobenONE', SetupCategory::Hardware, ['pt' => 'Docking station', 'en' => 'Docking station']),
    new SetupItem('Keychron K2', SetupCategory::Hardware, ['pt' => 'Teclado', 'en' => 'Keyboard']),
    new SetupItem('Redragon M656-MAX', SetupCategory::Hardware, ['pt' => 'Mouse', 'en' => 'Mouse']),

    new SetupItem('VS Code', SetupCategory::Software, ['pt' => 'Editor', 'en' => 'Editor']),
    new SetupItem('PhpStorm', SetupCategory::Software, ['pt' => 'IDE de PHP', 'en' => 'PHP IDE']),
    new SetupItem('Warp', SetupCategory::Software, ['pt' => 'Terminal', 'en' => 'Terminal']),
    new SetupItem('Dia', SetupCategory::Software, ['pt' => 'Navegador', 'en' => 'Browser']),
    new SetupItem('Claude', SetupCategory::Software, ['pt' => 'Assistente de IA', 'en' => 'AI assistant']),
];
