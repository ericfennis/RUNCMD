<?php if (!$node->theme['title_hide']) : ?>
<h1 class="<?= $node->theme['title_large'] ? 'uk-heading-large' : 'uk-article-title' ?>"><?= $page->title ?></h1>
<?php endif ?>
<p><?= $page->content ?></p>
