<?php

namespace Pagekit\Calendar\Controller;

use Pagekit\Application as App;
use Pagekit\Calendar\Model\Event;
use Pagekit\Module\Module;

class SiteController
{
    /**
     * @var Module
     */
    protected $calendar;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->calendar = App::module('calendar');
    }

    /**
     * @Route("/")
     * @Route("/page/{page}", name="page", requirements={"page" = "\d+"})
     */
    public function indexAction($page = 1)
    {
        if (!App::node()->hasAccess(App::user())) {
            App::abort(403, __('Insufficient User Rights.'));
        }

        $query = Event::where(['status = ?', 'date < ?'], [Event::STATUS_PUBLISHED, new \DateTime])->where(function ($query) {
            return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
        })->related('user');

        if (!$limit = $this->calendar->config('events.events_per_page')) {
            $limit = 15;
        }

        $count = $query->count('id');
        $total = ceil($count / $limit);
        $page = max(1, min($total, $page));

        $query->offset(($page - 1) * $limit)->limit($limit)->orderBy('eventDate', 'ASC');

        foreach ($events = $query->get() as $event) {
            $event->excerpt = App::content()->applyPlugins($event->excerpt, ['event' => $event, 'markdown' => $event->get('markdown')]);
            $event->content = App::content()->applyPlugins($event->content, ['event' => $event, 'markdown' => $event->get('markdown'), 'readmore' => true]);
        }

        return [
            '$view' => [
                'title' => __('Calendar'),
                'name' => 'calendar/events.php'
            ],
            'calendar' => $this->calendar,
            'events' => $events,
            'total' => $total,
            'page' => $page
        ];
    }



    /**
     * @Route("/{id}", name="id")
     */
    public function eventAction($id = 0)
    {
        if (!$event = Event::where(['id = ?', 'status = ?', 'date < ?'], [$id, Event::STATUS_PUBLISHED, new \DateTime])->related('user')->first()) {
            App::abort(404, __('Event not found!'));
        }

        if (!$event->hasAccess(App::user())) {
            App::abort(403, __('Insufficient User Rights.'));
        }

        $event->excerpt = App::content()->applyPlugins($event->excerpt, ['event' => $event, 'markdown' => $event->get('markdown')]);
        $event->content = App::content()->applyPlugins($event->content, ['event' => $event, 'markdown' => $event->get('markdown')]);

        $user = App::user();

        $description = $event->get('meta.og:description');
        if (!$description) {
            $description = strip_tags($event->excerpt ?: $event->content);
            $description = rtrim(mb_substr($description, 0, 150), " \t\n\r\0\x0B.,") . '...';
        }

        return [
            '$view' => [
                'title' => __($event->title),
                'name' => 'calendar/event.php',
                'og:type' => 'article',
                'article:published_time' => $event->date->format(\DateTime::ATOM),
                'article:modified_time' => $event->modified->format(\DateTime::ATOM),
                'article:author' => $event->user->name,
                'og:title' => $event->get('meta.og:title') ?: $event->title,
                'og:description' => $description,
                'og:image' =>  $event->get('image.src') ? App::url()->getStatic($event->get('image.src'), [], 0) : false
            ],
            'calendar' => $this->calendar,
            'event' => $event
        ];
    }
}
