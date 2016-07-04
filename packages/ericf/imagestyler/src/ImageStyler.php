<?php 

namespace Ericf\Imagestyler;

use Pagekit\Application as App;
use Pagekit\View\Helper\Helper;
use abeautifulsite\SimpleImage;

/**
* 
*/
class ImageStyler extends Helper {
	
	/**
	 * @var App
	 */
	protected $app;


	/**
	 * @var Style list
	 */
	private $styleList = [

			'themeImage' => [

				'name' 	=> 'best_fit',

				'width'	=> 480,

				'height'=> 360

			],
			'calendar' => [

				'name' 	=> 'best_fit',

				'width'	=> 480,

				'height'=> 360

			],

	];
	/**
	 * @param App $app
	 */
	public function __construct (App $app) {
		$this->app = $app;
	}

	public function __invoke ($styleName, $source) {

		
			return $this->getStyleUrl($styleName, $source);

	}

	/**
	 * {@inheritdoc}
	 */
	public function getName () {
		return 'ImageStyler';
	}
	/**
	 * {@inheritdoc}
	 */
	private function getStyleUrl ($style,$src) { 
		$styleList = $this->styleList;
		//$src = trim($src, '/');
		$pttrn  = '/\.(jpg|jpeg|gif|png)$/i';
		
		if(array_key_exists($style, $styleList)){
			return $this->styleImg($style,$src);
		} else {

			return 'http://placehold.it/800?text=Style%20doesn%27t%20Exist';
		}
	}

	protected function checkSrc ($src) {

		if (!file_exists($src)) {
			$src = 'http://placehold.it/800?text=Image%20url%20doesn%27t%20Exist';

		}
		return $src;
	}

	private function styleImg ($style, $src) {
		$cachepath = $this->getCachePath($src, $style);
		$styleList = $this->styleList;
		
		try {

			$cachepath = $this->getCachePath($src, $style);

			if (!file_exists($cachepath)) {

				$image = new SimpleImage(App::path() . '/' . $src);


				switch ($styleList[$style]['name']) {
					case 'resize':
						if (!empty($styleList['resize']['height']) && !empty($styleList['resize']['width'])) {
							$image->resize($styleList['resize']['width'], $styleList['resize']['height']);
						}
						break;
					case 'best_fit':
						if (!empty($styleList[$style]['width']) && empty($styleList[$style]['height'])) {
							$image->fit_to_width($styleList[$style]['width']);
						}
						if (!empty($styleList[$style]['height']) && empty($styleList[$style]['width'])) {
							$image->fit_to_height($styleList[$style]['height']);
						}
						if (!empty($styleList[$style]['height']) && !empty($styleList[$style]['width'])) {
							$image->thumbnail($styleList[$style]['width'], $styleList[$style]['height']);
						}
						break;
					case 'thumbnail':
						if (!empty($styleList['thumbnail']['width']) && empty($styleList['thumbnail']['height'])) {
							$image->fit_to_width($styleList['thumbnail']['width']);
						}
						if (!empty($styleList['thumbnail']['height']) && empty($styleList['thumbnail']['width'])) {
							$image->fit_to_height($styleList['thumbnail']['height']);
						}
						if (!empty($styleList['thumbnail']['height']) && !empty($styleList['thumbnail']['width'])) {
							$image->thumbnail($styleList['thumbnail']['width'], $styleList['thumbnail']['height']);
						}
						break;
					default:
       					if (!empty($styleList['thumbnail']['height']) && !empty($styleList['thumbnail']['width'])) {
							$image->thumbnail($styleList['thumbnail']['width'], $styleList['thumbnail']['height']);
						}
				}

				$image->save($cachepath);
			}

			return trim(str_replace(App::path(), '', $cachepath), '/');

		} catch (\Exception $e) {
			return false;
		}
	}

	protected function resizeImage ($source, $options) {
		try {

			$cachepath = $this->getCachePath($source, $options);

			if (!file_exists($cachepath)) {

				$image = new SimpleImage(App::path() . '/' . $source);

				if (!empty($options['width']) && empty($options['height'])) {
					$image->fit_to_width($options['width']);
				}
				if (!empty($options['height']) && empty($options['width'])) {
					$image->fit_to_height($options['height']);
				}
				if (!empty($options['height']) && !empty($options['width'])) {
					$image->thumbnail($options['width'], $options['height']);
				}

				$image->save($cachepath);
			}

			return trim(str_replace(App::path(), '', $cachepath), '/');

		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * @param string $source
	 * @param array $options
	 * @return string
	 */
	protected function getCachePath ($src, $style) {

		$folder = $this->app->module('ericf/imagestyler')->getCachepath();
		$cachename = md5($src . filemtime($src) . serialize($style)) . '-' . basename($src);

		return "$folder/$cachename";
	}

	/**
	 * @param array $options
	 */
	public static function clearCache ($options = []) {

		if (@$options['temp'] and $cache_path = App::module('ericf/imagestyler')->getCachepath()) {
			App::file()->delete($cache_path);
		}

	}



}