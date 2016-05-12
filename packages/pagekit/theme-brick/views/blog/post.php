<?php $view->script('post', 'blog:app/bundle/post.js', 'vue') ?>

<article class="uk-article">

    <?php if ($image = $post->get('image.src')): ?>
        <div class="tm-article-image">
            <img src="<?= $image ?>" alt="<?= $post->get('image.alt') ?>">
        </div>
    <?php endif ?>

    <div class="uk-grid">
        <div class="uk-width-large-1-4">

            <p class="uk-article-meta tm-article-date uk-margin-small">
                <time datetime="<?=$post->date->format(\DateTime::W3C)?>" v-cloak>{{ "<?=$post->date->format(\DateTime::W3C)?>" | date "shortDate" }}</time>
            </p>

        </div>
        <div class="uk-width-large-3-4">

            <h1 class="uk-article-title"><?= $post->title ?></h1>

            <div class="uk-margin"><?= $post->content ?></div>

            <p class="uk-article-meta uk-margin-remove"><?= __('Written by %name%', ['%name%' => $post->user->name]) ?></p>

            <?= $view->render('blog/comments.php') ?>

        </div>
   </div>

</article>
