<?php

use Pagekit\Application as App;
use Pagekit\Blog\Model\Post;

return [

    'name' => 'vision/rbp',

    'label' => 'Recent Blog Posts',

    'events' => [

        'view.scripts' => function($event, $scripts) use ($app) {
            $scripts->register('widget-rbp', 'recent-blog-posts:app/bundle/widget-rbp.js', ['~widgets']);
        }

    ],

    'render' => function($widget) use ($app) {

        $posts = Post::where(['status = ?', 'date < ?'], [Post::STATUS_PUBLISHED, new \DateTime])->where(function ($query) {
                return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
            })->related('user')->limit($widget->get('blog_posts_limit'))->orderBy('date', 'DESC')->get();


        if ($posts) {

            return $app->view('recent-blog-posts:views/recent-blog-posts-widget.php', compact('widget', 'posts'));
        }
    }

];
