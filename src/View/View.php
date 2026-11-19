<?php

declare(strict_types=1);

namespace App\View;

use RuntimeException;

/**
 * Renderiza templates em PHP puro (views/*.php).
 *
 * Dentro de um template, as chaves de $data viram variáveis locais e $this é esta
 * classe, então dá para chamar $this->partial(...), $this->icon(...) e $this->asset(...).
 */
final class View
{
    /** @var array<string, string> SVGs já processados, para não reler o arquivo a cada uso */
    private array $icons = [];

    /** @param array<string, mixed> $shared variáveis disponíveis em todos os templates */
    public function __construct(
        private readonly string $viewsDir,
        private readonly string $iconsDir,
        private readonly string $publicDir,
        private readonly array $shared = [],
    ) {}

    /** @param array<string, mixed> $data */
    public function render(string $template, array $data = []): string
    {
        $__file = "{$this->viewsDir}/{$template}.php";

        if (!is_file($__file)) {
            throw new RuntimeException("Template não encontrado: {$template}");
        }

        // A closure isola o escopo: o template enxerga só as variáveis de $data (e $this).
        $render = function (string $__file, array $__data): string {
            extract($__data, EXTR_SKIP);
            ob_start();

            try {
                require $__file;

                return (string) ob_get_contents();
            } finally {
                ob_end_clean();
            }
        };

        return $render($__file, [...$this->shared, ...$data]);
    }

    /** @param array<string, mixed> $data */
    public function partial(string $name, array $data = []): string
    {
        return $this->render("partials/{$name}", $data);
    }

    /**
     * URL de um arquivo de public/ com uma "versão" baseada no conteúdo (?v=...),
     * para o navegador baixar de novo só quando o arquivo mudar.
     */
    public function asset(string $path): string
    {
        $file = $this->publicDir . $path;

        return is_file($file) ? $path . '?v=' . substr((string) md5_file($file), 0, 10) : $path;
    }

    /**
     * SVG inline de resources/icons, herdando a cor do texto (currentColor).
     * O ícone é decorativo (aria-hidden): quem dá nome ao link é o texto ao lado dele.
     */
    public function icon(string $name, string $class = 'size-4'): string
    {
        return $this->icons["{$name}|{$class}"] ??= $this->loadIcon($name, $class);
    }

    private function loadIcon(string $name, string $class): string
    {
        $svg = @file_get_contents("{$this->iconsDir}/{$name}.svg");

        if ($svg === false || !preg_match('~<svg\b([^>]*)>(.*)</svg>~s', $svg, $match)) {
            throw new RuntimeException("Ícone não encontrado ou inválido: {$name}");
        }

        [, $attributes, $inner] = $match;

        // Tira tamanho, classe e papel originais do <svg>; quem controla isso é o $class.
        $attributes = (string) preg_replace('~\s(?:width|height|class|role)="[^"]*"~', '', $attributes);

        // Ícones de marca vêm sem "fill": pintamos com a cor do texto.
        if (!str_contains($attributes, 'fill=')) {
            $attributes .= ' fill="currentColor"';
        }

        $inner = trim((string) preg_replace('~<title>.*?</title>~s', '', $inner));

        return sprintf('<svg%s class="%s" aria-hidden="true" focusable="false">%s</svg>', $attributes, e($class), $inner);
    }
}
