<?php

return [

    'name' => 'recent-blog-posts',

    'type' => 'extension',

    'resources' => [

        'recent-blog-posts:' => '',

    ],

    'require' => [
        'pagekit/blog',
    ],

    'widgets' => [

        'widgets/rbp.php'

    ],

    'config' => [
        'blog_post_limit' => '3',
        'display-image' => false
    ]

];
