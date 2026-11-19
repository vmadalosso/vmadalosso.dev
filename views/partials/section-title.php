<?php
/**
 * Título de seção: serifa itálica seguida de um fio fino até a borda.
 *
 * @var string $id
 * @var string $title
 */
?>
<div class="mb-6 flex items-center gap-4">
    <h2 id="<?= e($id) ?>" class="font-serif text-[1.625rem] leading-none text-ink italic"><?= e($title) ?></h2>
    <span class="h-px flex-1 bg-line" aria-hidden="true"></span>
</div>
