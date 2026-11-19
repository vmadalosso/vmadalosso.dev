<?php
/**
 * Esqueleto HTML de todas as páginas: <head> com SEO, fontes, CSS e o script de tema.
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\I18n\Locale $locale
 * @var App\Content\Profile $profile
 * @var array{title: string, description: string, index: bool, path: string} $meta
 * @var string $body
 */

use App\App;
use App\Content\SocialLink;
use App\I18n\Locale;

$canonical = App::BASE_URL . $locale->url($meta['path']);

// Dados estruturados (schema.org) para buscadores entenderem quem é a pessoa do site.
$person = [
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => $profile->name,
    'url' => App::BASE_URL . '/',
    'image' => App::BASE_URL . $profile->avatar,
    'jobTitle' => $t->pick($profile->role),
    'alumniOf' => ['@type' => 'CollegeOrUniversity', 'name' => 'PUCRS'],
    'sameAs' => array_map(fn (SocialLink $link): string => $link->url, $profile->visibleLinks()),
];
?>
<!doctype html>
<html lang="<?= e($locale->htmlLang()) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($meta['title']) ?></title>
    <meta name="description" content="<?= e($meta['description']) ?>">
<?php if ($meta['index']): ?>
    <link rel="canonical" href="<?= e($canonical) ?>">
<?php foreach (Locale::cases() as $alternate): ?>
    <link rel="alternate" hreflang="<?= e($alternate->htmlLang()) ?>" href="<?= e(App::BASE_URL . $alternate->url($meta['path'])) ?>">
<?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= e(App::BASE_URL . Locale::Pt->url($meta['path'])) ?>">
<?php else: ?>
    <meta name="robots" content="noindex">
<?php endif; ?>

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e($profile->name) ?>">
    <meta property="og:title" content="<?= e($meta['title']) ?>">
    <meta property="og:description" content="<?= e($meta['description']) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:locale" content="<?= e($locale->ogLocale()) ?>">
    <?php /* Imagem da prévia de link (WhatsApp, LinkedIn etc.), uma por idioma, 1200x630. */ ?>
    <meta property="og:image" content="<?= e(App::BASE_URL . $this->asset("/assets/img/og-{$locale->value}.jpg")) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?= e($profile->name . ' · ' . $t->pick($profile->role)) ?>">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="theme-color" content="#f7f5f0" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#141318" media="(prefers-color-scheme: dark)">
    <link rel="icon" href="/favicon.ico" sizes="16x16 32x32 48x48">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preload" href="/assets/fonts/instrument-sans-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/newsreader-500.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?= e($this->asset('/assets/css/app.css')) ?>">

    <script>
        // Define o tema antes da primeira pintura, para a página não "piscar" de claro para escuro.
        // Vale a escolha salva pelo visitante; se não houver, a preferência do sistema.
        (() => {
            const root = document.documentElement;
            const system = matchMedia('(prefers-color-scheme: dark)');
            const saved = () => { try { return localStorage.getItem('theme'); } catch { return null; } };
            const apply = () => { root.dataset.theme = saved() ?? (system.matches ? 'dark' : 'light'); };
            apply();
            system.addEventListener('change', apply);
        })();
    </script>
    <script type="application/ld+json"><?= json_encode($person, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
</head>
<body class="min-h-dvh bg-paper font-sans text-ink antialiased">
    <a href="#conteudo" class="sr-only rounded-md bg-ink px-4 py-2 text-sm text-paper focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50"><?= e($t('skip')) ?></a>
<?= $body ?>
    <script>
        // Botão de tema. Só aparece com JavaScript ligado; sem JS, vale o tema do sistema.
        (() => {
            const button = document.querySelector('[data-theme-toggle]');
            if (!button) return;
            const root = document.documentElement;
            const sync = () => button.setAttribute('aria-pressed', String(root.dataset.theme === 'dark'));
            button.hidden = false;
            sync();
            new MutationObserver(sync).observe(root, { attributes: true, attributeFilter: ['data-theme'] });
            button.addEventListener('click', () => {
                root.dataset.theme = root.dataset.theme === 'dark' ? 'light' : 'dark';
                try { localStorage.setItem('theme', root.dataset.theme); } catch {}
            });
        })();
    </script>
</body>
</html>
