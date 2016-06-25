<?php

namespace Pagekit\Calendar\Model;

use Pagekit\Application as App;
use Pagekit\Database\ORM\ModelTrait;

trait EventModelTrait
{
    use ModelTrait;

    /**
     * @Saving
     */
    public static function saving($event, Event $event)
    {
        $event->modified = new \DateTime();

        $i  = 2;
        $id = $event->id;

        while (self::where('slug = ?', [$event->slug])->where(function ($query) use ($id) {
            if ($id) {
                $query->where('id <> ?', [$id]);
            }
        })->first()) {
            $event->slug = preg_replace('/-\d+$/', '', $event->slug).'-'.$i++;
        }
    }

}
