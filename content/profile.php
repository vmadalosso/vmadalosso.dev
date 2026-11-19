<?php

declare(strict_types=1);

use App\Content\Profile;
use App\Content\SocialLink;

// Quem você é, em poucas linhas. Textos com versão em PT e EN.
return new Profile(
    name: 'Vitor Madalosso',
    handle: '@vmadalosso',
    role: [
        'pt' => 'Dev full-stack',
        'en' => 'Full-stack developer',
    ],
    bio: [
        'pt' => 'Construo aplicações web e mobile de ponta a ponta para organizações que fazem diferença na comunidade.',
        'en' => 'I build web and mobile applications end to end for organizations that make a difference in their communities.',
    ],
    about: [
        [
            'pt' => 'Sou desenvolvedor full-stack, graduado em Análise e Desenvolvimento de Sistemas pela Pontifícia Universidade Católica do Rio Grande do Sul (PUCRS). Trabalho com o ecossistema moderno do JavaScript e tenho um carinho especial pelo bom e velho elefantinho do PHP. Gosto de entender, construir e manter os produtos em que trabalho, da ideia à produção.',
            'en' => "I'm a full-stack developer with a degree in Systems Analysis and Development at the Pontifical Catholic University of Rio Grande do Sul (PUCRS). I work across the modern JavaScript ecosystem and have a soft spot for good old PHP and its little elephant. I like to understand, build and maintain the products I work on, from idea to production.",
        ],
        [
            'pt' => 'Também dedico tempo a projetos voluntários para organizações que impactam positivamente a nossa sociedade. No momento, estou construindo o Indie SaaS, uma aplicação para facilitar a vida de devs, designers e pequenos consultores. Fora da tela, leio alguns livros, de Asimov a Kundera.',
            'en' => "I also give my time to volunteer projects for organizations that make a positive impact on our society. Right now I'm building Indie SaaS, an app to make life easier for developers, designers and independent consultants. Off-screen, I read a little of everything, from Asimov to Kundera.",
        ],
    ],
    avatar: '/assets/img/avatar.jpg',
    cv: '/cv/vitor-madalosso.pdf',   // currículo em inglês
    email: 'vitorconnected@gmail.com', // trocar por um @vmadalosso.dev quando existir
    links: [
        new SocialLink('GitHub', 'https://github.com/vmadalosso', 'github'),
        new SocialLink('LinkedIn', 'https://www.linkedin.com/in/vmadalosso', 'linkedin'),
        new SocialLink('Instagram', 'https://www.instagram.com/vmadalosso', 'instagram'),
        new SocialLink('Bluesky', 'https://bsky.app/profile/vmadalosso.bsky.social', 'bluesky'),
        // Ligue quando sair o primeiro vídeo:
        new SocialLink('YouTube', 'https://www.youtube.com/@vmadalosso', 'youtube', visible: false),
    ],
);
