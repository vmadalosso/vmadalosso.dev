<?php
/**
 * Linha da lista "Outros projetos".
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\Content\Project $project
 */

$primary = $project->primaryUrl();
?>
<li class="py-4 sm:flex sm:items-baseline sm:justify-between sm:gap-8">
    <div class="min-w-0">
        <p class="flex flex-wrap items-baseline gap-x-3">
            <?php if ($primary !== null): ?>
                <a href="<?= e($primary) ?>" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1 font-medium text-ink underline decoration-control underline-offset-4 transition-colors hover:decoration-ink">
                    <?= e($t->pick($project->name)) ?>
                    <?= $this->icon('arrow-up-right', 'size-3.5') ?>
                    <span class="sr-only">(<?= e($t('external')) ?>)</span>
                </a>
            <?php else: ?>
                <span class="font-medium text-ink"><?= e($t->pick($project->name)) ?></span>
            <?php endif; ?>

            <?php if ($project->url !== null && $project->repo !== null): ?>
                <a href="<?= e($project->repo) ?>" target="_blank" rel="noopener"
                   class="text-sm text-muted transition-colors hover:text-ink">
                    <?= e($t('projects.code')) ?><span class="sr-only"> (<?= e($t('external')) ?>)</span>
                </a>
            <?php endif; ?>
        </p>
        <p class="mt-1 text-[0.9375rem] leading-relaxed text-muted"><?= e($t->pick($project->summary)) ?></p>
    </div>

    <span class="mt-2 block shrink-0 text-xs font-semibold tracking-[0.1em] text-muted uppercase sm:mt-0">
        <?= e($t("kind.{$project->kind->value}")) ?> <span aria-hidden="true">·</span> <?= e($project->year) ?>
    </span>
</li>
