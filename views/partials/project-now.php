<?php
/**
 * Card "Construindo agora": ocupa a largura toda, com borda tracejada de "em obras".
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\Content\Project $project
 */
?>
<article class="flex flex-col rounded-xl border border-dashed border-control p-5 sm:col-span-2">
    <div class="flex items-center justify-between gap-3 text-xs">
        <span class="font-semibold tracking-[0.1em] text-accent uppercase"><?= e($t('projects.now')) ?></span>
        <?= $this->partial('status', ['status' => $project->status]) ?>
    </div>

    <h3 class="mt-4 font-serif text-[1.3125rem] leading-snug font-medium text-ink"><?= e($t->pick($project->name)) ?></h3>
    <p class="mt-2 max-w-[36rem] text-[0.9375rem] leading-relaxed text-muted"><?= e($t->pick($project->summary)) ?></p>
    <p class="mt-4 text-[0.8125rem] text-muted"><?= e(implode(' · ', $project->stack)) ?></p>
</article>
