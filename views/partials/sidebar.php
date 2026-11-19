<?php
/**
 * Perfil: foto, nome, bio, currículo e redes. No desktop fica fixo enquanto a página rola.
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\Content\Profile $profile
 */
?>
<header class="lg:sticky lg:top-28 lg:w-64 lg:shrink-0 lg:self-start">
    <?php /* alt vazio: a foto é decorativa, o nome logo abaixo já diz quem é. */ ?>
    <img src="<?= e($profile->avatar) ?>" alt="" width="128" height="128"
         class="size-28 rounded-full border border-line bg-surface object-cover lg:size-32">

    <h1 class="mt-6 font-serif text-[2.375rem] leading-[1.05] font-medium tracking-[-0.01em] text-ink">
        <?= e($profile->name) ?>
    </h1>
    <p class="mt-2 text-[0.9375rem] text-muted">
        <?= e($t->pick($profile->role)) ?> <span aria-hidden="true">·</span> <?= e($profile->handle) ?>
    </p>
    <p class="mt-5 text-[0.9375rem] leading-relaxed text-ink"><?= e($t->pick($profile->bio)) ?></p>

    <?php if ($profile->cv !== null): ?>
        <a href="<?= e($profile->cv) ?>" target="_blank" rel="noopener"
           class="mt-6 inline-flex items-center gap-2 rounded-full border border-control px-4 py-2 text-sm font-medium text-ink transition-colors hover:border-ink hover:bg-surface">
            <?= $this->icon('download', 'size-4') ?>
            <?= e($t('cv')) ?>
            <span class="text-muted"><?= e($t('cv.meta')) ?></span>
            <span class="sr-only">(<?= e($t('external')) ?>)</span>
        </a>
    <?php endif; ?>

    <?php /* No celular, grade de 2 colunas: com flex-wrap a 2ª coluna de cada linha começava num ponto diferente. */ ?>
    <ul class="mt-8 grid grid-cols-[auto_auto] justify-start gap-x-6 gap-y-3 sm:flex sm:flex-wrap lg:flex-col lg:gap-3.5">
        <?php foreach ($profile->visibleLinks() as $link): ?>
            <li>
                <?php /* rel="me": diz a outros sites que este perfil é seu (verificação no Mastodon, Bluesky etc.). */ ?>
                <a href="<?= e($link->url) ?>" target="_blank" rel="noopener me"
                   class="group inline-flex items-center gap-2.5 text-[0.9375rem] text-muted transition-colors hover:text-ink">
                    <?= $this->icon($link->icon, 'size-4 shrink-0') ?>
                    <span><?= e($link->label) ?></span>
                    <?= $this->icon('arrow-up-right', 'size-3.5 opacity-0 transition-opacity group-hover:opacity-100 group-focus-visible:opacity-100') ?>
                    <span class="sr-only">(<?= e($t('external')) ?>)</span>
                </a>
            </li>
        <?php endforeach; ?>

        <?php if ($profile->email !== null): ?>
            <li class="col-span-2">
                <a href="mailto:<?= e($profile->email) ?>"
                   class="inline-flex items-center gap-2.5 text-[0.9375rem] text-muted transition-colors hover:text-ink">
                    <?= $this->icon('mail', 'size-4 shrink-0') ?>
                    <span><?= e($profile->email) ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</header>
