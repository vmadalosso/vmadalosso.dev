<?php
/**
 * Card de projeto em destaque.
 *
 * O título é um link "esticado" (o ::after cobre o card inteiro), então o card todo é clicável;
 * os links do rodapé (site e código) ficam por cima dele com z-10.
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\Content\Project $project
 */

$primary = $project->primaryUrl();
?>
<article class="relative flex flex-col rounded-xl border border-line bg-surface p-5 transition-colors hover:border-control">
    <div class="flex items-center justify-between gap-3 text-xs">
        <span class="font-semibold tracking-[0.1em] text-muted uppercase">
            <?= e($t("kind.{$project->kind->value}")) ?> <span aria-hidden="true">·</span> <?= e($project->year) ?>
        </span>
        <?= $this->partial('status', ['status' => $project->status]) ?>
    </div>

    <h3 class="mt-4 font-serif text-[1.3125rem] leading-snug font-medium text-ink">
        <?php if ($primary !== null): ?>
            <a href="<?= e($primary) ?>" target="_blank" rel="noopener"
               class="after:absolute after:inset-0 after:rounded-xl focus-visible:outline-none focus-visible:after:outline-2 focus-visible:after:outline-offset-2 focus-visible:after:outline-accent">
                <?= e($t->pick($project->name)) ?><span class="sr-only"> (<?= e($t('external')) ?>)</span>
            </a>
        <?php else: ?>
            <?= e($t->pick($project->name)) ?>
        <?php endif; ?>
    </h3>

    <p class="mt-2 text-[0.9375rem] leading-relaxed text-muted"><?= e($t->pick($project->summary)) ?></p>
    <p class="mt-4 mb-5 text-[0.8125rem] leading-relaxed text-muted"><?= e(implode(' · ', $project->stack)) ?></p>

    <?php /* Rodapé: site à esquerda e código à direita (só o ícone, para caber numa linha). */ ?>
    <div class="relative z-10 mt-auto flex items-center justify-between gap-4 border-t border-line pt-4 text-sm">
        <?php if ($project->url !== null): ?>
            <a href="<?= e($project->url) ?>" target="_blank" rel="noopener"
               class="inline-flex min-w-0 items-center gap-1 text-ink underline decoration-control underline-offset-4 transition-colors hover:decoration-ink">
                <span class="truncate"><?= e($project->displayUrl()) ?></span>
                <?= $this->icon('arrow-up-right', 'size-3.5 shrink-0') ?>
                <span class="sr-only">(<?= e($t('external')) ?>)</span>
            </a>

            <?php if ($project->repo !== null): ?>
                <a href="<?= e($project->repo) ?>" target="_blank" rel="noopener"
                   title="<?= e($t('projects.code_github')) ?>"
                   class="-m-1 shrink-0 rounded-md p-1 text-muted transition-colors hover:text-ink">
                    <?= $this->icon('github', 'size-4') ?>
                    <span class="sr-only"><?= e($t('projects.code_github')) ?> (<?= e($t('external')) ?>)</span>
                </a>
            <?php endif; ?>
        <?php elseif ($project->repo !== null): ?>
            <a href="<?= e($project->repo) ?>" target="_blank" rel="noopener"
               class="inline-flex items-center gap-1.5 text-muted transition-colors hover:text-ink">
                <?= $this->icon('github', 'size-4') ?>
                <?= e($t('projects.code_github')) ?>
                <span class="sr-only">(<?= e($t('external')) ?>)</span>
            </a>
        <?php endif; ?>
    </div>
</article>
