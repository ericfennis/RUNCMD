<?php foreach ($widgets as $widget) : ?>
<div class="uk-width-medium-1-<?= count($widgets) ?>">

    <div class="<?= $widget->theme['panel'] ?> <?= $widget->theme['alignment'] ? 'uk-text-center' : '' ?> <?= $widget->theme['html_class'] ?>">

        <?php if (!$widget->theme['title_hide']) : ?>
        <h3><?= $widget->title ?></h3>
        <?php endif ?>

        <?= $widget->get('result') ?>

    </div>

</div>
<?php endforeach ?>
