<?php

declare(strict_types=1);

namespace App\I18n;

/**
 * Idiomas do site. O português fica na raiz (/) e o inglês em /en/.
 */
enum Locale: string
{
    case Pt = 'pt';
    case En = 'en';

    /**
     * Descobre o idioma pelo começo do caminho e devolve o caminho sem o prefixo.
     * Ex.: "/en/projetos" → [En, "/projetos"]; "/" → [Pt, "/"].
     *
     * @return array{self, string}
     */
    public static function fromPath(string $path): array
    {
        if ($path === '/en' || str_starts_with($path, '/en/')) {
            return [self::En, substr($path, 3) ?: '/'];
        }

        return [self::Pt, $path];
    }

    /** URL de uma página neste idioma: Pt → "/", En → "/en/". */
    public function url(string $path = '/'): string
    {
        return match ($this) {
            self::Pt => $path,
            self::En => '/en' . $path,
        };
    }

    /** Valor do atributo lang do <html> e do hreflang. */
    public function htmlLang(): string
    {
        return match ($this) {
            self::Pt => 'pt-BR',
            self::En => 'en',
        };
    }

    /** Formato usado pelo Open Graph (og:locale). */
    public function ogLocale(): string
    {
        return match ($this) {
            self::Pt => 'pt_BR',
            self::En => 'en_US',
        };
    }

    /** Nome do idioma escrito nele mesmo, para o seletor PT/EN. */
    public function label(): string
    {
        return match ($this) {
            self::Pt => 'Português',
            self::En => 'English',
        };
    }
}
