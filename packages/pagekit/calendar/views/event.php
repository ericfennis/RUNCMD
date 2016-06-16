<?php $view->script('event', 'calendar:app/bundle/event.js', 'vue') ?>

<article class="uk-article">

    <?php if ($imageData = $event->get('image.src')): ?>
		
	<?php 
		 $imageData = $event->get('image.src');
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
    <img src="<?= $imageData ?>" alt="<?= $event->get('image.alt') ?>">
    <?php endif ?>

    <h1 class="uk-article-title"><?= $event->title ?></h1>

    <div class="uk-margin"><?= $event->content ?></div>

</article>
