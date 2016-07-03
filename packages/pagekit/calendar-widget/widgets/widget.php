<?php

use Pagekit\Application as App;
use Pagekit\Calendar\Model\Event;

return [

    'name' => 'calendar_widget',

    'label' => 'Calendar Widget',

    // 'events' => [

    //     'view.scripts' => function($event, $scripts) use ($app) {
    //         $scripts->register('widget-rbp', 'recent-blog-posts:app/bundle/widget-rbp.js', ['~widgets']);
    //     }

    // ],

    'render' => function($widget) use ($app) {

        $events = Event::where(['status = ?', 'date < ?'], [Event::STATUS_PUBLISHED, new \DateTime])->where(function ($query) {
                return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
            })->orderBy('eventDate', 'DESC')->get();


        if ($events) {

            return $app->view('calendar-widget:views/calendar-widget.php', compact('widget', 'events'));
        }
    }

];
