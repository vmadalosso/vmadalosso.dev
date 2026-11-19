<?php
/**
 * Home: perfil à esquerda (fixo ao rolar, no desktop) e as seções à direita.
 *
 * @var App\View\View $this
 * @var App\I18n\Translator $t
 * @var App\Content\Content $content
 * @var App\Content\Profile $profile
 */

use App\Content\Placement;
use App\Content\SetupCategory;
use App\Content\Shelf;

$others = $content->projects(Placement::Other);
?>
<div class="relative mx-auto max-w-5xl px-6 pt-20 pb-16 sm:px-8 lg:flex lg:gap-16 lg:pt-28">
    <?= $this->partial('controls') ?>
    <?= $this->partial('sidebar') ?>

    <main id="conteudo" class="mt-16 min-w-0 flex-1 lg:mt-0">
        <section aria-labelledby="about">
            <h2 id="about" class="sr-only"><?= e($t('about.title')) ?></h2>
            <div class="max-w-[38rem] space-y-5 text-[1.0625rem] leading-[1.75] text-ink">
                <?php foreach ($profile->about as $paragraph): ?>
                    <p><?= e($t->pick($paragraph)) ?></p>
                <?php endforeach; ?>
            </div>
        </section>

        <section aria-labelledby="projects" class="mt-20">
            <?= $this->partial('section-title', ['id' => 'projects', 'title' => $t('projects.title')]) ?>

            <div class="grid gap-4 sm:grid-cols-2">
                <?php foreach ($content->projects(Placement::Featured) as $project): ?>
                    <?= $this->partial('project-card', ['project' => $project]) ?>
                <?php endforeach; ?>

                <?php foreach ($content->projects(Placement::Now) as $project): ?>
                    <?= $this->partial('project-now', ['project' => $project]) ?>
                <?php endforeach; ?>
            </div>

            <?php if ($others !== []): ?>
                <h3 class="mt-12 text-xs font-semibold tracking-[0.14em] text-muted uppercase"><?= e($t('projects.others')) ?></h3>
                <ul class="mt-3 divide-y divide-line border-y border-line">
                    <?php foreach ($others as $project): ?>
                        <?= $this->partial('project-other', ['project' => $project]) ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <section aria-labelledby="stack" class="mt-20">
            <?= $this->partial('section-title', ['id' => 'stack', 'title' => $t('stack.title')]) ?>

            <ul class="flex flex-wrap gap-2">
                <?php foreach ($content->stack as $tech): ?>
                    <li class="inline-flex items-center gap-2 rounded-lg border border-line bg-surface px-3 py-2 text-sm text-ink">
                        <?= $this->icon($tech->icon, 'size-4 text-muted') ?>
                        <?= e($tech->name) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section aria-labelledby="reading" class="mt-20">
            <?= $this->partial('section-title', ['id' => 'reading', 'title' => $t('books.title')]) ?>

            <div class="grid gap-10 sm:grid-cols-2 sm:gap-8">
                <?php foreach (Shelf::cases() as $shelf): ?>
                    <div>
                        <h3 class="text-xs font-semibold tracking-[0.14em] text-muted uppercase"><?= e($t("books.{$shelf->value}")) ?></h3>
                        <ul class="mt-4 space-y-4">
                            <?php foreach ($content->books($shelf) as $book): ?>
                                <li>
                                    <cite class="block font-serif text-[1.125rem] leading-snug text-ink"><?= e($t->pick($book->title)) ?></cite>
                                    <span class="mt-0.5 block text-sm text-muted"><?= e($book->author) ?></span>
                                    <?php if ($book->note !== null): ?>
                                        <?php /* Nota pessoal: serifa itálica e cinza, como uma anotação na margem. */ ?>
                                        <p class="mt-1.5 font-serif text-[0.9375rem] leading-snug text-muted italic"><?= e($t->pick($book->note)) ?></p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section aria-labelledby="setup" class="mt-20">
            <?= $this->partial('section-title', ['id' => 'setup', 'title' => $t('setup.title')]) ?>

            <div class="grid gap-10 sm:grid-cols-2 sm:gap-8">
                <?php foreach (SetupCategory::cases() as $category): ?>
                    <div>
                        <h3 class="text-xs font-semibold tracking-[0.14em] text-muted uppercase"><?= e($t("setup.{$category->value}")) ?></h3>
                        <ul class="mt-4 space-y-2.5 text-[0.9375rem]">
                            <?php foreach ($content->setup($category) as $item): ?>
                                <?php /* Linha pontilhada entre nome e descrição, como num sumário de livro. */ ?>
                                <li class="flex items-baseline gap-2">
                                    <span class="text-ink"><?= e($item->name) ?></span>
                                    <span class="min-w-4 flex-1 -translate-y-1 border-b border-dotted border-control" aria-hidden="true"></span>
                                    <span class="text-right text-sm text-muted"><?= e($t->pick($item->detail)) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?= $this->partial('footer') ?>
    </main>
</div>
