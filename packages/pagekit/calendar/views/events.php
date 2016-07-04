<?php $view->script('events', 'calendar:app/bundle/events.js', 'vue') ?>
<?php $view->script('events', 'calendar:app/bundle/events.js', ['uikit-grid', 'jquery']) ?>

<article class="uk-article uk-container uk-container-center">
<h1>Events</h1>
        <div class="uk-clearfix uk-grid-width-1-1 uk-grid-width-small-1-1 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3" data-uk-grid="{gutter: 40}">
    
<?php  

    $noContent = array('content'=>"<div class=uk-panel><h3>Sorry er zijn voorlopig geen evenementen</h3></div>"); 

?>
<?php //print_r($events) ?>

<?php foreach ($events as $event) : ?>

  
<?php 
    date_default_timezone_set('Europe/Amsterdam');
    $date = $event->eventDate->getTimestamp();
    
?>
<div data-uk-filter>
            <div class="uk-panel uk-text-left event-item box-shadow">

                    <figure>
                    <?php if ($image = $event->get('image.src')): ?>
                                <a class="uk-display-block" href="<?= $view->url('@calendar/id', ['id' => $event->id]) ?>">
                                    <div class="lock-ratio">
                                        <img src="<?= $view->ImageStyler('calendar',$image); ?>" alt="<?= $event->get('image.alt') ?>">
                                    </div>
                                </a>
                <?php endif ?>
                    </figure>
                    <div class="event-content">
                        <div class="event-date">
                            <span class="event-date-number">
                                <?= date ('j',$date); ?>
                            </span>
                            <span class="event-date-month">
                                <?= date ('M',$date); ?>
                            </span>
                        </div>
                        <div class="event-title">
                            <h3 class="uk-h3"><a href="<?= $view->url('@calendar/id', ['id' => $event->id]) ?>"><?= $event->title ?></a></h3>
                        </div>
                        
                    </div>
        
            </div>
        </div>

<?php endforeach ?>

       </div>
</article> 
        
        




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
