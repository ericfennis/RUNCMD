<?php 	

namespace Ericf\Imagestyler\Controller;

use Pagekit\Application as App;
use Ericf\Imagestyler\Model\Style;

/**
 * @Access(admin=true)
 */
class ImagestylerController
{
    public function indexAction($filter = null, $page = null)
    {
    	// App::on('view.layout', function ($event, $view) {
     //        $event['demo'] = 'Hello World';
     //    });

        return [
            '$view' => [
                'title' => __('Image styles'),
                'name'  => 'ericf/imagestyler/admin/style-index.php'
            ],
            '$data' => [

                'canEditAll' => App::user()->hasAccess('imagestyler: manage styles'),
                'config'   => [
                    'filter' => (object) $filter,
                    'page'   => $page
                ]
            ]
        ];
    }

     /**
     * @Route("/style/edit", name="style/edit")
     * @Access("\: manage styles")
     * @Request({"id": "int"})
     */
    public function editAction($id = 0) {
    
    	try {

            if (!$style = Style::where(compact('id'))->first()) {

                if ($id) {
                    App::abort(404, __('Invalid style id.'));
                }

				$module = App::module('ericf/imagestyler');

				$project = Style::create([
					'data' => [],
					//'status' => 1
				]);

			}


            return [
                '$view' => [
                    'title' => $id ? __('Edit style') : __('Add style'),
                    'name'  => 'ericf/imagestyler/admin/style-edit.php'
                ],
                '$data' => [
					'config' => App::module('ericf/imagestyler')->config(),
                	'style'  => $style,
                	'style_settings' => [ 
                		'resize' => __('Resize'),
                		'best_fit' =>  __('Best Fit'),
                		'thumbnail' =>  __('Thumbnail')
                	]
                ],
                'style' => $style
            ];

        } catch (\Exception $e) {

            App::message()->error($e->getMessage());

            return App::redirect('@imagestyler');
        }

    
    }

}
