<?php

use Pagekit\Application as App;
use Ericf\Imagestyler\ImageStyler;

return [

    'name' => 'ericf/imagestyler',

    'type' => 'extension',

    'main' => 'Ericf\\Imagestyler\\ImagestylerModule',

    'autoload' => [

        'Ericf\\Imagestyler\\' => 'src'

	],

    'routes' => [

        '/imagestyler' => [
            'name' => '@imagestyler',
            'controller' => [
                'Ericf\\Imagestyler\\Controller\\ImagestylerController'
            ]
        ],
        '/api/imagestyler' => [
			'name' => '@imagestyler/api',
			'controller' => [
				'Ericf\\Imagestyler\\Controller\\StyleApiController',
				//'Ericf\\Imagestyler\\Controller\\ImageApiController'
			]
		]

    ],

    'menu' => [

        // name, can be used for menu hierarchy
        'imagestyler' => [
            'label' => 'Image Styler',
            'icon' => 'imagestyler:icon.svg',
            'url' => '@imagestyler',
            'access' => 'imagestyler: manage styles'
        ]

    ],

    'permissions' => [

        // Unique name.
        // Convention: extension name and speaking name of this permission (spaces allowd)
        'imagestyler: manage styles' => [
            'title' => 'Manage styles'
        ],

    ],

    'config' => [
    	'cache_path' => str_replace(App::path(), '', App::get('path.cache') . '/imagestyler')
    ],

    'events' => [

		'boot' => function ($event, $app) {
			$app->extend('view', function ($view) use ($app) {
				return $view->addHelper(new ImageStyler($app));
			});
			//todo event to clear cache?
		}
	]


    ];