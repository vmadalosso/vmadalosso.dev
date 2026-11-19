<?php
/**
 * Bolinha colorida + rótulo do status do projeto.
 *
 * @var App\I18n\Translator $t
 * @var App\Content\ProjectStatus $status
 */

use App\Content\ProjectStatus;

// Classes escritas por extenso para o Tailwind encontrá-las ao gerar o CSS.
$dot = match ($status) {
    ProjectStatus::Live => 'bg-live',
    ProjectStatus::Building => 'bg-building',
    ProjectStatus::PersonalUse => 'bg-muted',
};
?>
<span class="inline-flex shrink-0 items-center gap-1.5 text-muted">
    <span class="size-1.5 rounded-full <?= $dot ?>" aria-hidden="true"></span>
    <?= e($t("status.{$status->value}")) ?>
</span>
