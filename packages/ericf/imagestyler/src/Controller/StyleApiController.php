<?php

namespace Ericf\Imagestyler\Controller;

use Pagekit\Application as App;
use Ericf\Imagestyler\Model\Style;

/**
 * @Access("imagestyler: manage styles")
 * @Route("style", name="style")
 */
class StyleApiController
{
    /**
     * @Route("/", methods="GET")
     * @Request({"filter": "array", "page":"int"})
     */
    public function indexAction($filter = [], $page = 0)
    {
        $query  = Project::query();
        $filter = array_merge(array_fill_keys(['search', 'status', 'order', 'limit'], ''), $filter);

        extract($filter, EXTR_SKIP);

		if (!preg_match('/^(date|title|status)\s(asc|desc)$/i', $order, $order)) {
            $order = [1 => 'date', 2 => 'desc'];
        }

        $limit = 80;
        $count = $query->count();
        $pages = ceil($count / $limit);
        $page  = max(0, min($pages - 1, $page));

        $styles = array_values($query->offset($page * $limit)->limit($limit)->orderBy($order[1], $order[2])->get());

        return compact('styles', 'pages', 'count');
    }

    /**
     * @Route("/{id}", methods="GET", requirements={"id"="\d+"})
     */
    public function getAction($id)
    {
        return Project::where(compact('id'))->first();
    }

    /**
     * @Route("/", methods="POST")
     * @Route("/{id}", methods="POST", requirements={"id"="\d+"})
     * @Request({"style": "array", "id": "int"}, csrf=true)
     */
    public function saveAction($data, $id = 0)
    {
        if (!$id || !$style = Project::find($id)) {

            if ($id) {
                App::abort(404, __('Project not found.'));
            }

			$style = Project::create();
        }

        if (!$data['slug'] = App::filter($data['slug'] ?: $data['title'], 'slugify')) {
            App::abort(400, __('Invalid slug.'));
        }


		$style->save($data);

        return ['message' => 'success', 'style' => $style];
    }

    /**
     * @Route("/{id}", methods="DELETE", requirements={"id"="\d+"})
     * @Request({"id": "int"}, csrf=true)
     */
    public function deleteAction($id)
    {
        if ($style = Project::find($id)) {

            if(!App::user()->hasAccess('portfolio: manage styles')) {
                return ['error' => __('Access denied.')];
            }

			$style->delete();
        }

        return ['message' => 'success'];
    }

    /**
     * @Route("/bulk", methods="POST")
     * @Request({"styles": "array"}, csrf=true)
     */
    public function bulkSaveAction($styles = [])
    {
        foreach ($styles as $data) {
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
