<?php

declare(strict_types=1);

use App\Content\Placement;
use App\Content\Project;
use App\Content\ProjectKind;
use App\Content\ProjectStatus;

/*
 * Projetos, na ordem em que aparecem na home.
 * Featured = grade principal · Now = "Construindo agora" · Other = lista compacta.
 * Resumo enxuto: uma frase, o card já mostra tipo, ano e stack.
 */

return [
    new Project(
        slug: 'instituto-movimenta',
        name: 'Instituto Movimenta',
        kind: ProjectKind::Volunteer,
        status: ProjectStatus::Live,
        placement: Placement::Featured,
        year: 2026,
        summary: [
            'pt' => 'ONG de impacto social do RS: site institucional e painel administrativo para gerenciar o cursinho popular.',
            'en' => 'A social-impact NGO in southern Brazil: website and admin panel to manage its community prep course.',
        ],
        stack: ['Next.js', 'TypeScript', 'Supabase', 'Tailwind CSS'],
        url: 'https://www.institutomovimenta.org',
        repo: 'https://github.com/vmadalosso/instituto-movimenta',
    ),
    new Project(
        slug: 'biblioteca-cristal',
        // \u{00A0} é um espaço que não quebra: o título quebra em "Biblioteca Comunitária / do Cristal".
        name: "Biblioteca Comunitária do\u{00A0}Cristal",
        kind: ProjectKind::Volunteer,
        status: ProjectStatus::Live,
        placement: Placement::Featured,
        year: 2025,
        summary: [
            'pt' => 'Site institucional feito como trabalho voluntário durante a graduação na PUCRS.',
            'en' => 'Institutional website built as volunteer work during my degree at PUCRS.',
        ],
        stack: ['HTML', 'Tailwind CSS', 'JavaScript'],
        url: 'https://biblioteca-cristal.vercel.app',
        repo: 'https://github.com/vmadalosso/biblioteca-cristal',
    ),
    new Project(
        slug: 'safemed-id',
        name: 'SafeMed ID',
        kind: ProjectKind::Degree,
        status: ProjectStatus::Live,
        placement: Placement::Featured,
        year: 2025,
        summary: [
            'pt' => 'Perfil médico para emergências, acessado por QR Code e protegido por senha.',
            'en' => 'An emergency medical profile, accessed by QR code and protected by a password.',
        ],
        stack: ['React', 'Node.js', 'Express', 'Prisma', 'PostgreSQL'],
        url: 'https://pucrs-safemed-web.vercel.app',
        repo: 'https://github.com/vmadalosso/pucrs-safemed-fullstack',
    ),
    new Project(
        slug: 'workout-tracker',
        name: 'Workout Tracker',
        kind: ProjectKind::Personal,
        status: ProjectStatus::PersonalUse,
        placement: Placement::Featured,
        year: 2026,
        summary: [
            'pt' => 'Acompanhamento semanal de treino, pensado para usar pelo celular na academia e monitorar a progressão.',
            'en' => 'A weekly workout tracker, designed for use on a phone at the gym and for keeping an eye on progress.',
        ],
        stack: ['Next.js', 'TypeScript', 'Supabase'],
        repo: 'https://github.com/vmadalosso/workout-tracker', // o app em si pede login
    ),

    new Project(
        slug: 'indie-saas',
        name: 'Indie SaaS',
        kind: ProjectKind::Product,
        status: ProjectStatus::Building,
        placement: Placement::Now,
        year: 2026,
        summary: [
            'pt' => 'Gestão para devs, designers e pequenos consultores: clientes, projetos, horas e contratos num lugar só.',
            'en' => 'Management for developers, designers and independent consultants: clients, projects, hours and contracts in one place.',
        ],
        stack: ['Next.js', 'TypeScript', 'Supabase'],
    ),

    new Project(
        slug: 'sysinfo-report',
        name: 'SysInfo Report',
        kind: ProjectKind::Tool,
        status: ProjectStatus::Live,
        placement: Placement::Other,
        year: 2024,
        summary: [
            'pt' => 'Diagnóstico de hardware e sistema para técnicos de TI, em um executável.',
            'en' => 'Hardware and OS diagnostics for IT technicians, in a single executable.',
        ],
        stack: ['Node.js', 'JavaScript'],
        repo: 'https://github.com/vmadalosso/sysinfo-report',
    ),
    new Project(
        slug: 'task-manager',
        name: 'Task Manager',
        kind: ProjectKind::Challenge,
        status: ProjectStatus::Live,
        placement: Placement::Other,
        year: 2026,
        summary: [
            'pt' => 'Gerenciador de tarefas com sincronização em tempo real, feito com Spec Driven Development.',
            'en' => 'A task manager with real-time sync, built with Spec-Driven Development.',
        ],
        stack: ['React', 'TypeScript', 'Supabase'],
        url: 'https://task-manager-fullstack-olive.vercel.app',
        repo: 'https://github.com/vmadalosso/task-manager-fullstack',
    ),
];
