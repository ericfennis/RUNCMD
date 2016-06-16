<?php

namespace Pagekit\Calendar;

use Pagekit\Application as App;
use Pagekit\Calendar\Model\Event;
use Pagekit\Routing\ParamsResolverInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class UrlResolver implements ParamsResolverInterface
{
    const CACHE_KEY = 'calendar.routing';

    /**
     * @var bool
     */
    protected $cacheDirty = false;

    /**
     * @var array
     */
    protected $cacheEntries;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cacheEntries = App::cache()->fetch(self::CACHE_KEY) ?: [];
    }

    /**
     * {@inheritdoc}
     */
    public function match(array $parameters = [])
    {
        if (isset($parameters['id'])) {
            return $parameters;
        }

        if (!isset($parameters['slug'])) {
            App::abort(404, 'Event not found.');
        }

        $slug = $parameters['slug'];

        $id = false;
        foreach ($this->cacheEntries as $entry) {
            if ($entry['slug'] === $slug) {
                $id = $entry['id'];
            }
        }

        if (!$id) {

            if (!$event = Event::where(compact('slug'))->first()) {
                App::abort(404, 'Event not found.');
            }

            $this->addCache($event);
            $id = $event->id;
        }

        $parameters['id'] = $id;
        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(array $parameters = [])
    {
        $id = $parameters['id'];

        if (!isset($this->cacheEntries[$id])) {

            if (!$event = Event::where(compact('id'))->first()) {
                throw new RouteNotFoundException('Event not found!');
            }

            $this->addCache($event);
        }

        $meta = $this->cacheEntries[$id];

        preg_match_all('#{([a-z]+)}#i', self::getPermalink(), $matches);

        if ($matches) {
            foreach($matches[1] as $attribute) {
                if (isset($meta[$attribute])) {
                    $parameters[$attribute] = $meta[$attribute];
                }
            }
        }

        unset($parameters['id']);
        return $parameters;
    }

    public function __destruct()
    {
        if ($this->cacheDirty) {
            App::cache()->save(self::CACHE_KEY, $this->cacheEntries);
        }
    }

    /**
     * Gets the calendar's permalink setting.
     *
     * @return string
     */
    public static function getPermalink()
    {
        static $permalink;

        if (null === $permalink) {

            $calendar = App::module('calendar');
            $permalink = $calendar->config('permalink.type');

            if ($permalink == 'custom') {
                $permalink = $calendar->config('permalink.custom');
            }

        }

        return $permalink;
    }

    protected function addCache($event)
    {
        $this->cacheEntries[$event->id] = [
            'id'     => $event->id,
            'slug'   => $event->slug,
            'year'   => $event->date->format('Y'),
            'month'  => $event->date->format('m'),
            'day'    => $event->date->format('d'),
            'hour'   => $event->date->format('H'),
            'minute' => $event->date->format('i'),
            'second' => $event->date->format('s'),
        ];

        $this->cacheDirty = true;
    }
}
