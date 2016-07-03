<?php 	

namespace Ericf\Imagestyler;

use Pagekit\Application as App;
use Pagekit\Module\Module;

class ImagestylerModule extends Module {
	/**
	 * @var array
	 */
	protected $types;

	/**
	 * {@inheritdoc}
	 */
	public function main (App $app) {
	}

	/**
	 * @return bool|string
	 */
	public function getCachepath () {
		$folder = App::path() .'/'.App::module('ericf/imagestyler')->config('cache_path');
		if (file_exists($folder) && is_writable($folder)) { //all fine, quick return
			return $folder;
		}
		//try to create cache folder
		App::file()->makeDir($folder, 0755);
		if (!file_exists($folder)) {
			//create folder
			$folder = $this->app['path.cache'] . '/imagestyler';
			if (!file_exists($folder)) {
				App::file()->makeDir($folder, 0755);
			}
		}
		if (!file_exists($folder) || !is_writable($folder)) { //return false if it doesn't work.
			return false;
		}
		return $folder;
	}
}
