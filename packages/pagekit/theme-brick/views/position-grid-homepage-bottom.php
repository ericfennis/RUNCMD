<div class="uk-container uk-container-center" data-uk-grid-match data-uk-grid-margin>
	<div class="uk-grid">
	<?php foreach ($widgets as $widget) : ?>
	<div class="uk-width-medium-1-<?= count($widgets) ?>">

	<div class="uk-panel <?= $widget->theme['panel'] ?> <?= $widget->theme['alignment'] ? 'uk-text-center' : '' ?> <?= $widget->theme['html_class'] ?>">

	    <?php if (!$widget->theme['title_hide']) : ?>
	    <h1><?= $widget->title ?></h1>
	    <?php endif ?>

	    <?= $widget->get('result') ?>

	</div>

	</div>
	<?php endforeach ?>
	</div>
	</div>