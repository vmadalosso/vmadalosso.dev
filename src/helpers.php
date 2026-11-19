<?php

declare(strict_types=1);

/**
 * Escapa texto para HTML. Todo dado dinâmico passa por aqui antes de ir para a página:
 * é o que impede que um "<script>" num conteúdo vire código executado (XSS).
 */
function e(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}
