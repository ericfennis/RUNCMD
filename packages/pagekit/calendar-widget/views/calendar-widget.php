<?php $view->script('event', 'calendar:app/bundle/event.js', 'vue') ?>

<?php foreach ($events as $event): ?>

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
                                        <img src="<?= $image ?>" alt="<?= $event->get('image.alt') ?>">
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

<?php endforeach; ?>
