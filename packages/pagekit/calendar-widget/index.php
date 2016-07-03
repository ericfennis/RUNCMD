<?php

return [

    'name' => 'calendar-widget',

    'type' => 'extension',

    'resources' => [

        'calendar-widget:' => '',

    ],

    'require' => [
        'pagekit/calendar',
    ],

    'widgets' => [

        'widgets/widget.php'

    ],

    // 'config' => [
    //     'display-image' => true
    // ]

];
