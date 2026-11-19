<?php

declare(strict_types=1);

/*
 * Ponto de entrada (front controller): toda requisição passa por aqui.
 *
 * No servidor embutido do PHP (php -S), arquivos que existem em public/
 * (CSS, fontes, imagens) são entregues direto: é o que faz o "return false".
 */
if (PHP_SAPI === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

require __DIR__ . '/../vendor/autoload.php';

App\App::boot(dirname(__DIR__))
    ->handle($_SERVER['REQUEST_URI'] ?? '/')
    ->send();
