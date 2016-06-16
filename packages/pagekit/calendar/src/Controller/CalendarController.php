<?php

namespace Pagekit\Calendar\Controller;

use Pagekit\Application as App;
use Pagekit\Calendar\Model\Event;
use Pagekit\User\Model\Role;

/**
 * @Access(admin=true)
 */
class CalendarController
{
    /**
     * @Access("calendar: manage own events || calendar: manage all events")
     * @Request({"filter": "array", "page":"int"})
     */
    public function eventAction($filter = null, $page = null)
    {
        return [
            '$view' => [
                'title' => __('Events'),
                'name'  => 'calendar/admin/event-index.php'
            ],
            '$data' => [
                'statuses' => Event::getStatuses(),

                'canEditAll' => App::user()->hasAccess('calendar: manage all events'),
                'config'   => [
                    'filter' => (object) $filter,
                    'page'   => $page
                ]
            ]
        ];
    }

    /**
     * @Route("/event/edit", name="event/edit")
     * @Access("calendar: manage own events || calendar: manage all events")
     * @Request({"id": "int"})
     */
    public function editAction($id = 0)
    {
        try {

            if (!$event = Event::where(compact('id'))->related('user')->first()) {

                if ($id) {
                    App::abort(404, __('Invalid event id.'));
                }

                $module = App::module('calendar');

                $event = Event::create([
                    'user_id' => App::user()->id,
                    'status' => Event::STATUS_DRAFT,
                    'date' => new \DateTime(),
                    'eventDate' => new \DateTime()
                ]);

                $event->set('title', $module->config('events.show_title'));
                $event->set('markdown', $module->config('events.markdown_enabled'));
            }

            $user = App::user();
            if(!$user->hasAccess('calendar: manage all events') && $event->user_id !== $user->id) {
                App::abort(403, __('Insufficient User Rights.'));
            }

            $roles = App::db()->createQueryBuilder()
                ->from('@system_role')
                ->where(['id' => Role::ROLE_ADMINISTRATOR])
                ->whereInSet('permissions', ['Calendar: manage all events', 'Calendar: manage own events'], false, 'OR')
                ->execute('id')
                ->fetchAll(\PDO::FETCH_COLUMN);

            $authors = App::db()->createQueryBuilder()
                ->from('@system_user')
                ->whereInSet('roles', $roles)
                ->execute('id, username')
                ->fetchAll();

            return [
                '$view' => [
                    'title' => $id ? __('Edit Event') : __('Add Event'),
                    'name'  => 'calendar/admin/event-edit.php'
                ],
                '$data' => [
                    'event'     => $event,
                    'statuses' => Event::getStatuses(),
                    'roles'    => array_values(Role::findAll()),
                    'canEditAll' => $user->hasAccess('Calendar: manage all events'),
                ],
                'event' => $event
            ];

        } catch (\Exception $e) {

            App::message()->error($e->getMessage());

            return App::redirect('@calendar/event');
        }
    }

    /**
     * @Access("calendar: manage settings")
     */
    public function settingsAction()
    {
        return [
            '$view' => [
                'title' => __('Calendar Settings'),
                'name'  => 'calendar:views/admin/settings.php'
            ],
            '$data' => [
                'config' => App::module('calendar')->config()
            ]
        ];
    }
}
