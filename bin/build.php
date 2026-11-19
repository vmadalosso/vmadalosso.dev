#!/usr/bin/env php
<?php

declare(strict_types=1);

/*
 * Gera a versão estática do site em dist/, pronta para Cloudflare Pages, GitHub Pages etc.
 *
 * Usa o mesmo App do servidor: cada URL de App::staticPages() é renderizada e gravada
 * como arquivo, e o resto de public/ (CSS, fontes, imagens) é copiado junto.
 *
 * Uso: composer build   (compila o CSS e roda este script)
 */

use App\App;

require __DIR__ . '/../vendor/autoload.php';

$root = dirname(__DIR__);
$public = "{$root}/public";
$dist = "{$root}/dist";

if (!is_file("{$public}/assets/css/app.css")) {
    fwrite(STDERR, "CSS não encontrado. Rode antes: bin/tailwind --minify\n");
    exit(1);
}

// Começa do zero para não sobrar arquivo de um build anterior.
removeDirectory($dist);
mkdir($dist, recursive: true);

// 1. Arquivos estáticos de public/, menos o index.php (que é o servidor).
copyDirectory($public, $dist, skip: ['index.php']);

// 2. Páginas renderizadas pelo App.
$app = App::boot($root);

foreach ($app->staticPages() as $url => $file) {
    $response = $app->handle($url);
    $target = "{$dist}/{$file}";

    if (!is_dir(dirname($target))) {
        mkdir(dirname($target), recursive: true);
    }

    file_put_contents($target, $response->body);
    printf("  %-14s → dist/%s (%d)\n", $url, $file, $response->status);
}

echo "Pronto: dist/\n";

function copyDirectory(string $from, string $to, array $skip = []): void
{
    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($from, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
    );

    foreach ($items as $item) {
        $relative = substr($item->getPathname(), strlen($from) + 1);

        if (in_array($relative, $skip, true) || $item->getFilename() === '.DS_Store') {
            continue;
        }

        $target = "{$to}/{$relative}";
        $item->isDir() ? @mkdir($target, recursive: true) : copy($item->getPathname(), $target);
    }
}

function removeDirectory(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }

    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST,
    );

    foreach ($items as $item) {
        $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
    }

    rmdir($dir);
}
