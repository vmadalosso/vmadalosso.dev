<?php
/**
 * Página não encontrada.
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\I18n\Locale $locale
 */
?>
<div class="relative mx-auto flex min-h-dvh max-w-xl flex-col justify-center px-6 py-24">
    <?= $this->partial('controls') ?>

    <main id="conteudo">
        <p class="font-serif text-7xl leading-none text-muted italic" aria-hidden="true">404</p>
        <h1 class="mt-6 font-serif text-3xl font-medium text-ink"><?= e($t('404.title')) ?></h1>
        <p class="mt-3 text-muted"><?= e($t('404.text')) ?></p>
        <a href="<?= e($locale->url('/')) ?>"
           class="mt-8 inline-flex text-ink underline decoration-control underline-offset-4 transition-colors hover:decoration-ink">
            <?= e($t('404.back')) ?>
        </a>
    </main>
</div>
