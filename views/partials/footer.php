<?php
/**
 * @var App\I18n\Translator $t
 * @var App\Content\Profile $profile
 */
?>
<footer class="mt-24 flex flex-col gap-1 border-t border-line pt-6 text-sm text-muted sm:flex-row sm:justify-between">
    <p>© <?= date('Y') ?> <?= e($profile->name) ?></p>
    <p><?= e($t('footer.made')) ?></p>
</footer>
