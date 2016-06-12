<?php

namespace Pagekit\Calendar\Event;

use Pagekit\Calendar\Model\Event;
use Pagekit\Event\EventSubscriberInterface;

class EventListener implements EventSubscriberInterface
{


    public function onRoleDelete($event, $role)
    {
        Event::removeRole($role);
    }

    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'model.role.deleted' => 'onRoleDelete'
        ];
    }
}
