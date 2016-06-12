<?php $view->script('events', 'calendar:app/bundle/events.js', 'vue') ?>

<?php foreach ($events as $event) : ?>
<article class="uk-article">

    <?php if ($image = $event->get('image.src')): ?>
    <a class="uk-display-block" href="<?= $view->url('@calendar/id', ['id' => $event->id]) ?>"><img src="<?= $image ?>" alt="<?= $event->get('image.alt') ?>"></a>
    <?php endif ?>

    <h1 class="uk-article-title"><a href="<?= $view->url('@calendar/id', ['id' => $event->id]) ?>"><?= $event->title ?></a></h1>

    <p class="uk-article-meta">
        <?= __('Written by %name% on %date%', ['%name%' => $event->user->name, '%date%' => '<time datetime="'.$event->date->format(\DateTime::ATOM).'" v-cloak>{{ "'.$event->date->format(\DateTime::ATOM).'" | date "longDate" }}</time>' ]) ?>
    </p>

    <div class="uk-margin"><?= $event->excerpt ?: $event->content ?></div>

    <ul class="uk-subnav">

        <?php if (isset($event->readmore) && $event->readmore || $event->excerpt) : ?>
        <li><a href="<?= $view->url('@calendar/id', ['id' => $event->id]) ?>"><?= __('Read more') ?></a></li>
        <?php endif ?>

    </ul>

</article>
<?php endforeach ?>

<?php

    $range     = 3;
    $total     = intval($total);
    $page      = intval($page);
    $pageIndex = $page - 1;

?>

<?php if ($total > 1) : ?>
<ul class="uk-pagination">


    <?php for($i=1;$i<=$total;$i++): ?>
        <?php if ($i <= ($pageIndex+$range) && $i >= ($pageIndex-$range)): ?>

            <?php if ($i == $page): ?>
            <li class="uk-active"><span><?=$i?></span></li>
            <?php else: ?>
            <li>
                <a href="<?= $view->url('@calendar/page', ['page' => $i]) ?>"><?=$i?></a>
            <li>
            <?php endif; ?>

        <?php elseif($i==1): ?>

            <li>
                <a href="<?= $view->url('@calendar/page', ['page' => 1]) ?>">1</a>
            </li>
            <li><span>...</span></li>

        <?php elseif($i==$total): ?>

            <li><span>...</span></li>
            <li>
                <a href="<?= $view->url('@calendar/page', ['page' => $total]) ?>"><?=$total?></a>
            </li>

        <?php endif; ?>
    <?php endfor; ?>


</ul>
<?php endif ?>
