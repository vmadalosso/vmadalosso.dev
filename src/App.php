<?php

declare(strict_types=1);

namespace App;

use App\Content\Content;
use App\Http\Response;
use App\I18n\Locale;
use App\I18n\Translator;
use App\View\View;

/**
 * O site inteiro cabe aqui: recebe uma URL e devolve uma Response.
 *
 * O mesmo código atende o servidor (public/index.php) e o build estático
 * (bin/build.php), então o que você vê em desenvolvimento é o que vai pro ar.
 */
final readonly class App
{
    /** Endereço público, usado nas URLs absolutas (canonical, Open Graph, sitemap). */
    public const string BASE_URL = 'https://vmadalosso.dev';

    private function __construct(
        private string $root,
        private Content $content,
    ) {}

    public static function boot(string $root): self
    {
        return new self($root, Content::load("{$root}/content"));
    }

    public function handle(string $uri): Response
    {
        $path = '/' . trim((string) parse_url($uri, PHP_URL_PATH), '/');
        [$locale, $path] = Locale::fromPath($path);

        return match ($path) {
            '/' => $this->page('home', $locale),
            '/sitemap.xml' => $this->sitemap(),
            default => $this->page('404', $locale, status: 404),
        };
    }

    /**
     * O que o build estático grava em dist/: URL → arquivo.
     * Página nova no site = linha nova aqui.
     *
     * @return array<string, string>
     */
    public function staticPages(): array
    {
        return [
            '/' => 'index.html',
            '/en/' => 'en/index.html',
            '/404' => '404.html',
            '/en/404' => 'en/404.html',
            '/sitemap.xml' => 'sitemap.xml',
        ];
    }

    private function page(string $name, Locale $locale, int $status = 200): Response
    {
        $t = Translator::load($locale, "{$this->root}/lang");
        $profile = $this->content->profile;

        $view = new View(
            viewsDir: "{$this->root}/views",
            iconsDir: "{$this->root}/resources/icons",
            publicDir: "{$this->root}/public",
            shared: [
                't' => $t,
                'locale' => $locale,
                'content' => $this->content,
                'profile' => $profile,
            ],
        );

        $meta = match ($name) {
            'home' => [
                'title' => $t('meta.title'),
                'description' => $t->pick($profile->bio),
                'index' => true,
            ],
            '404' => [
                'title' => $t('404.title') . ' · ' . $profile->name,
                'description' => $t('404.text'),
                'index' => false,
            ],
        };

        $html = $view->render('layout', [
            'meta' => [...$meta, 'path' => '/'],
            'body' => $view->render("pages/{$name}"),
        ]);

        return new Response($html, $status);
    }

    private function sitemap(): Response
    {
        $urls = [];

        foreach (Locale::cases() as $locale) {
            $alternates = array_map(
                fn (Locale $alt): string => sprintf(
                    '<xhtml:link rel="alternate" hreflang="%s" href="%s"/>',
                    $alt->htmlLang(),
                    e(self::BASE_URL . $alt->url('/')),
                ),
                Locale::cases(),
            );

            $urls[] = sprintf(
                '<url><loc>%s</loc>%s</url>',
                e(self::BASE_URL . $locale->url('/')),
                implode('', $alternates),
            );
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">'
            . implode('', $urls)
            . "</urlset>\n";

        return new Response($xml, headers: ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
