<?php $view->script('post', 'blog:app/bundle/post.js', 'vue') ?>

<article class="uk-article">
    <h1 class="uk-article-title"><?= $post->title ?></h1>

    <p class="uk-article-meta">
        <?= __('Written by %name% on %date%', ['%name%' => $post->user->name, '%date%' => '<time datetime="'.$post->date->format(\DateTime::W3C).'" v-cloak>{{ "'.$post->date->format(\DateTime::W3C).'" | date "longDate" }}</time>' ]) ?>
    </p>

    <div class="uk-margin">
      <?php if ($image = $post->get('image.src')): ?>
      <img class="uk-border-circle" src="<?= $image ?>" alt="<?= $post->get('image.alt') ?>">
      <?php endif ?>
      <?= $post->content ?>
    </div>

    <?= $view->render('blog/comments.php') ?>

</article>
