<?php foreach ($widgets as $widget) : ?>
<div class="uk-panel <?= $widget->theme['panel'] ?> <?= $widget->theme['alignment'] ? 'uk-text-center' : '' ?> <?= $widget->theme['html_class'] ?>">

    <?php if (!$widget->theme['title_hide']) : ?>
    <h1 class="<?= $widget->theme['title_size'] ?>"><?= $widget->title ?></h1>
    <?php endif ?>

    <?= $widget->get('result') ?>

</div>
<?php endforeach ?>
