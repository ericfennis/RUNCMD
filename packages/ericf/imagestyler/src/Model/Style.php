<?php 

namespace Ericf\Imagestyler\Model;

use Pagekit\Application as App;
use Pagekit\System\Model\DataModelTrait;

/**
 * @Entity(tableClass="@imagestyler")
 */
class Style implements \JsonSerializable
{
	use DataModelTrait, StyleModelTrait;

	/** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="string") */
    public $title;

    /** @Column(type="string") */
    public $style;

    /** @Column(type="json_array") */
    public $style_settings;

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = [
            'url' => App::url('@portfolio/id', ['id' => $this->id ?: 0], 'base')
        ];

        return $this->toArray($data);
    }

}