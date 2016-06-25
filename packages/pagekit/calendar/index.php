<?php

use Pagekit\Application;
use Pagekit\Calendar\Event\EventListener;
use Pagekit\Calendar\Event\RouteListener;

/*
 * This array is the module definition.
 * It's used by Pagekit to load your extension and register all things
 * that your extension provides (routes, menu items, php classes etc)
 */
return [

    /*
     * Define a unique name.
     */
    'name' => 'calendar',

    /*
     * Define the type of this module.
     * Has to be 'extension' here. Can be 'theme' for a theme.
     */
    'type' => 'extension',

    /*
     * Main entry point. Called when your extension is both installed and activated.
     * Either assign an closure or a string that points to a PHP class.
     * Example: 'main' => 'Pagekit\\Calendar\\CalendarExtension'
     */
    'main' => function (Application $app) {

        // bootstrap code

    },

    /*
     * Register all namespaces to be loaded.
     * Map from namespace to folder where the classes are located.
     * Remember to escape backslashes with a second backslash.
     */
    'autoload' => [

        'Pagekit\\Calendar\\' => 'src'

    ],

    /*
     * Define nodes. A node is similar to a route with the difference
     * that it can be placed anywhere in the menu structure. The
     * resulting route is therefore determined on runtime.
     */
    'nodes' => [

        'calendar' => [

            // The name of the node route
            'name' => '@calendar',

            // Label to display in the backend
            'label' => 'Calendar',

            // The controller for this node. Each controller action will be mounted
            'controller' => 'Pagekit\\Calendar\\Controller\\SiteController',

            // A unique node that cannot be deleted, resides in "Not Linked" by default
            'protected' => true

        ],
        

    ],

    'permissions' => [

        'calendar: manage own events' => [
            'title' => 'Manage own events',
            'description' => 'Create, edit, delete and publish events of their own'
        ],
        'calendar: manage all events' => [
            'title' => 'Manage all events',
            'description' => 'Create, edit, delete and publish events by all users'
        ]
    ],
    /*
     * Define routes.
     */
    'routes' => [

        '/calendar' => [
            'name' => '@calendar',
            'controller' => [
                'Pagekit\\Calendar\\Controller\\CalendarController'
            ]
        ],
        '/api/calendar' => [
            'name' => '@calendar/api',
            'controller' => [
                'Pagekit\\Calendar\\Controller\\EventApiController'
            ]
        ],
        '@todo' => [

            // which path this extension should be mounted to
            'path' => '/events',

            // which controller to mount
            'controller' => 'Pagekit\\Calendar\\Controller\\CalendarController'
        ]

    ],

    /*
     * Define menu items for the backend.
     */
    'menu' => [

        // name, can be used for menu hierarchy
        'calendar' => [
            'label' => 'Calendar',
            'icon' => 'calendar:icon.svg',
            'url' => '@calendar/event',
            'active' => '@calendar/event*',
            'access' => 'calendar: manage own events || calendar: manage all events || system: manage settings',
            'priority' => 110
        ],
        'calendar: events' => [
            'label' => 'Events',
            'parent' => 'calendar',
            'url' => '@calendar/event',
            'active' => '@calendar/event*',
            'access' => 'calendar: manage own events || calendar: manage all events'
        ],
        'calendar: settings' => [
            'label' => 'Settings',
            'parent' => 'calendar',
            'url' => '@calendar/settings',
            'active' => '@calendar/settings*',
            'access' => 'system: manage settings'
        ]

    ],

    /*
     * Link to a settings screen from the extensions listing.
     */
    'settings' => '@calendar/settings',

    /*
     * Default module configuration.
     * Can be overwritten by changed config during runtime.
     */
    'config' => [

        'events' => [

            'events_per_page' => 20,
            'markdown_enabled' => true

        ],

        'permalink' => [
            'type' => '',
            'custom' => '{slug}'
        ],

    ],

    /*
     * Listen to events.
     */
    'events' => [

        'boot' => function ($event, $app) {
            $app->subscribe(
                new RouteListener,
                new EventListener()
            );
        },

        'view.scripts' => function ($event, $scripts) {
            $scripts->register('calendar-link', 'calendar:app/bundle/link.js', '~panel-link');

        }

    ]

];
