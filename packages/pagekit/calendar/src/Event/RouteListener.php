<?php

namespace Pagekit\Calendar\Event;

use Pagekit\Application as App;
use Pagekit\Calendar\UrlResolver;
use Pagekit\Event\EventSubscriberInterface;

class RouteListener implements EventSubscriberInterface
{
    /**
     * Adds cache breaker to router.
     */
    public function onAppRequest()
    {
        App::router()->setOption('calendar.permalink', UrlResolver::getPermalink());
    }

    /**
     * Registers permalink route alias.
     */
    public function onConfigureRoute($event, $route)
    {
        if ($route->getName() == '@calendar/id' && UrlResolver::getPermalink()) {
            App::routes()->alias(dirname($route->getPath()).'/'.ltrim(UrlResolver::getPermalink(), '/'), '@calendar/id', ['_resolver' => 'Pagekit\Calendar\UrlResolver']);
        }
    }

    /**
     * Clears resolver cache.
     */
    public function clearCache()
    {
        App::cache()->delete(UrlResolver::CACHE_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'request' => ['onAppRequest', 130],
            'route.configure' => 'onConfigureRoute',
            'model.post.saved' => 'clearCache',
            'model.post.deleted' => 'clearCache'
        ];
    }
}
