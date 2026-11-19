<?php

declare(strict_types=1);

namespace App\I18n;

/**
 * Textos da interface (lang/pt.php e lang/en.php) e escolha do idioma certo
 * nos conteúdos que têm versão em português e em inglês.
 */
final readonly class Translator
{
    /** @param array<string, string> $strings */
    public function __construct(
        public Locale $locale,
        private array $strings,
    ) {}

    public static function load(Locale $locale, string $langDir): self
    {
        return new self($locale, require "{$langDir}/{$locale->value}.php");
    }

    /** Texto da interface pela chave. Nos templates: $t('projects.title'). */
    public function __invoke(string $key): string
    {
        return $this->strings[$key] ?? $key;
    }

    /**
     * Escolhe a versão do idioma atual de um conteúdo.
     * Aceita uma string (igual nos dois idiomas) ou ['pt' => '...', 'en' => '...'].
     *
     * @param string|array<string, string> $value
     */
    public function pick(string|array $value): string
    {
        if (is_string($value)) {
            return $value;
        }

        return $value[$this->locale->value] ?? $value[Locale::Pt->value];
    }
}
