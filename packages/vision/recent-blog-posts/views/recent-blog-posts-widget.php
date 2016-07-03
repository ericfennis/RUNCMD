<?php $view->script('post', 'blog:app/bundle/post.js', 'vue') ?>

<?php foreach ($posts as $post): ?>

    <article class="uk-article">

        <?php if ($widget->get('display_image')): ?>
            <?php if ($image = $post->get('image.src')): ?>
                <img src="<?= $image ?>" alt="<?= $post->get('image.alt') ?>">
            <?php endif ?>
        <?php endif ?>


        <h1 class="uk-article-title"><?= $post->title ?></h1>

        <p class="uk-article-meta">
            <?= __('Written by %name% on %date%', ['%name%' => $post->user->name, '%date%' => '<time datetime="'.$post->date->format(\DateTime::ATOM).'" v-cloak>{{ "'.$post->date->format(\DateTime::ATOM).'" | date "longDate" }}</time>' ]) ?>
        </p>

        <div class="uk-margin">
            <?= $app->markdown()->parse($post->excerpt) ?: $app->markdown()->parse($post->content) ?>
        </div>

        <ul class="uk-subnav">
            <?php if (isset($post->readmore) && $post->readmore || $post->excerpt) : ?>
            <li><a href="<?= $view->url('@blog/id', ['id' => $post->id]) ?>"><?= __('Read more') ?></a></li>
            <?php endif ?>
        </ul>

    </article>

<?php endforeach; ?>
