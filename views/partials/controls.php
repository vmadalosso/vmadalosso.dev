<?php
/**
 * Canto superior direito: idioma (PT/EN) e tema claro/escuro.
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\I18n\Locale $locale
 */

use App\I18n\Locale;
?>
<div class="absolute top-6 right-6 flex items-center gap-1 text-[0.8125rem] sm:right-8">
    <nav aria-label="<?= e($t('lang.label')) ?>" class="flex items-center">
        <?php foreach (Locale::cases() as $option): ?>
            <?php $current = $option === $locale; ?>
            <a href="<?= e($option->url('/')) ?>"
               hreflang="<?= e($option->htmlLang()) ?>"
               lang="<?= e($option->htmlLang()) ?>"
               aria-label="<?= e($option->label()) ?>"
               <?= $current ? 'aria-current="true"' : '' ?>
               class="rounded-md px-2 py-1.5 font-semibold tracking-[0.08em] uppercase transition-colors <?= $current ? 'text-ink' : 'text-muted hover:text-ink' ?>">
                <?= e($option->value) ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <span class="mx-1 h-4 w-px bg-line" aria-hidden="true"></span>

    <button type="button" data-theme-toggle hidden aria-pressed="false" aria-label="<?= e($t('theme.dark')) ?>"
            class="rounded-md p-1.5 text-muted transition-colors hover:text-ink">
        <?= $this->icon('moon', 'size-[1.125rem] dark:hidden') ?>
        <?= $this->icon('sun', 'hidden size-[1.125rem] dark:block') ?>
    </button>
</div>
