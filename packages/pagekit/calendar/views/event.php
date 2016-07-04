<?php $view->script('event', 'calendar:app/bundle/event.js', 'vue') ?>

<article id="event" class="uk-article">

    <?php if ($imageData = $event->get('image.src')): ?>
		
	<?php 
		$imageData = $event->get('image.src');

		date_default_timezone_set('Europe/Amsterdam');
    	$date = $event->eventDate->getTimestamp();


		// $imageDecode=base64_decode($imageData);
		// $iMagick = new Imagick();

		// $iMagick->readimageblob($image);

		// // Rezise max of 200x82
		// $width=$iMagick->getImageWidth();
		// if ($width > 200) { $iMagick->thumbnailImage(200,null,0); }

		// $height=$iMagick->getImageHeight();
		// if ($height > 82) { $iMagick->thumbnailImage(null,82,0); }

		// $image = $iMagick->getimageblob();
		// $image = $iMagick->getFormat();
  	?>
    <img src="<?= $view->ImageStyler('calendar',$imageData) ?>" alt="<?= $event->get('image.alt') ?>">
    <?php endif ?>

	<div class="box-shadow event-date">
		<span class="event-date-number">
            <?= date ('j',$date); ?>
        </span>
        <span class="event-date-month">
            <?= date ('M',$date); ?>
        </span>
	</div>
    <h1><?= $event->title ?></h1>

	<a href="<?= $event->facebook_url ?>" class="facebook-button button box-shadow">Facebook Event</a>

	<?php if(!empty($event->tickets_url)): ?>
	<a href="<?= $event->tickets_url ?>" class="button box-shadow">Tickets</a>
	<?php endif; ?>

    <div class="uk-margin"><?= $event->content ?></div>

</article>
