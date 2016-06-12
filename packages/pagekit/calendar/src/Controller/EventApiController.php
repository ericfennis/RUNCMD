<?php

namespace Pagekit\Calendar\Controller;

use Pagekit\Application as App;
use Pagekit\Calendar\Model\Event;

/**
 * @Access("calendar: manage own events || calendar: manage all events")
 * @Route("event", name="event")
 */
class EventApiController
{
    /**
     * @Route("/", methods="GET")
     * @Request({"filter": "array", "page":"int"})
     */
    public function indexAction($filter = [], $page = 0)
    {
        $query  = Event::query();
        $filter = array_merge(array_fill_keys(['status', 'search', 'order', 'limit'], ''), $filter);

        extract($filter, EXTR_SKIP);

        if(!App::user()->hasAccess('calendar: manage all events')) {
            $author = App::user()->id;
        }

        if (is_numeric($status)) {
            $query->where(['status' => (int) $status]);
        }

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->orWhere(['title LIKE :search', 'slug LIKE :search'], ['search' => "%{$search}%"]);
            });
        }

        if (!preg_match('/^(date|title)\s(asc|desc)$/i', $order, $order)) {
            $order = [1 => 'date', 2 => 'desc'];
        }

        $limit = (int) $limit ?: App::module('calendar')->config('events.events_per_page');
        $count = $query->count();
        $pages = ceil($count / $limit);
        $page  = max(0, min($pages - 1, $page));

       $events = array_values($query->offset($page * $limit)->limit($limit)->orderBy($order[1], $order[2])->get());

        return compact('events', 'pages', 'count');
    }

    /**
     * @Route("/", methods="POST")
     * @Route("/{id}", methods="POST", requirements={"id"="\d+"})
     * @Request({"event": "array", "id": "int"}, csrf=true)
     */
    public function saveAction($data, $id = 0)
    {
        if (!$id || !$event = Event::find($id)) {

            if ($id) {
                App::abort(404, __('Event not found.'));
            }

            $event = Event::create();
        }

        if (!$data['slug'] = App::filter($data['slug'] ?: $data['title'], 'slugify')) {
            App::abort(400, __('Invalid slug.'));
        }

        // user without universal access is not allowed to assign events to other users
        if(!App::user()->hasAccess('calendar: manage all events')) {
            $data['user_id'] = App::user()->id;
        }

        // user without universal access can only edit their own events
        if(!App::user()->hasAccess('calendar: manage all events') && !App::user()->hasAccess('calendar: manage own events') && $event->user_id !== App::user()->id) {
            App::abort(400, __('Access denied.'));
        }

        $event->save($data);

        return ['message' => 'success', 'event' => $event];
    }

    /**
     * @Route("/{id}", methods="DELETE", requirements={"id"="\d+"})
     * @Request({"id": "int"}, csrf=true)
     */
    public function deleteAction($id)
    {
        if ($event = Event::find($id)) {

            if(!App::user()->hasAccess('calendar: manage all events') && !App::user()->hasAccess('calendar: manage own events') && $event->user_id !== App::user()->id) {
                App::abort(400, __('Access denied.'));
            }

            $event->delete();
        }

        return ['message' => 'success'];
    }

    /**
     * @Route(methods="POST")
     * @Request({"ids": "int[]"}, csrf=true)
     */
    public function copyAction($ids = [])
    {
        foreach ($ids as $id) {
            if ($event = Event::find((int) $id)) {
                if(!App::user()->hasAccess('calendar: manage all events') && !App::user()->hasAccess('calendar: manage own events') && $event->user_id !== App::user()->id) {
                    continue;
                }

                $event = clone $event;
                $event->id = null;
                $event->status = Event::STATUS_DRAFT;
                $event->title = $event->title.' - '.__('Copy');
                $event->date = new \DateTime();
                $event->save();
            }
        }

        return ['message' => 'success'];
    }

    /**
     * @Route("/bulk", methods="POST")
     * @Request({"events": "array"}, csrf=true)
     */
    public function bulkSaveAction($events = [])
    {
        foreach ($events as $data) {
            $this->saveAction($data, isset($data['id']) ? $data['id'] : 0);
        }

        return ['message' => 'success'];
    }

    /**
     * @Route("/bulk", methods="DELETE")
     * @Request({"ids": "array"}, csrf=true)
     */
    public function bulkDeleteAction($ids = [])
    {
        foreach (array_filter($ids) as $id) {
            $this->deleteAction($id);
        }

        return ['message' => 'success'];
    }
}
