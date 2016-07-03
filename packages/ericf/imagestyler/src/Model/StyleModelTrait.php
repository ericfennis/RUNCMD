<?php

namespace Ericf\Imagestyler\Model;

use Pagekit\Application as App;
use Pagekit\Database\ORM\ModelTrait;

trait StyleModelTrait
{
    use ModelTrait;


    /**
     * @Saving
     */
    public static function saving($event, Style $style)
    {
		// //slug
  //       $i  = 2;
  //       $id = $project->id;

  //       while (self::where('slug = ?', [$project->slug])->where(function ($query) use ($id) {
  //           if ($id) {
  //               $query->where('id <> ?', [$id]);
  //           }
  //       })->first()) {
		// 	$project->slug = preg_replace('/-\d+$/', '', $project->slug).'-'.$i++;
  //       }
		//prio
		if (!$project->id) {
			$project->priority = 1 + self::getConnection()->fetchColumn('SELECT MAX(priority) FROM @portfolio_project');
		}

    }

}
