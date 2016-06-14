<?php

namespace Pagekit\Calendar\Model;

use Pagekit\Application as App;
use Pagekit\System\Model\DataModelTrait;
use Pagekit\User\Model\AccessModelTrait;
use Pagekit\User\Model\User;

/**
 * @Entity(tableClass="@calendar")
 */
class Event implements \JsonSerializable
{
    use AccessModelTrait, DataModelTrait, EventModelTrait;

    /* Event draft status. */
    const STATUS_DRAFT = 0;

    /* Event pending review status. */
    const STATUS_PENDING_REVIEW = 1;

    /* Event published. */
    const STATUS_PUBLISHED = 2;

    /* Event unpublished. */
    const STATUS_UNPUBLISHED = 3;

    /** @Column(type="integer") @Id */
    public $id;

    /** @Column(type="string") */
    public $title;

    /** @Column(type="string") */
    public $slug;

    /** @Column(type="integer") */
    public $user_id;

    /** @Column(type="datetime") */
    public $date;

    /** @Column(type="text") */
    public $content = '';

    /** @Column(type="datetime") */
    public $eventDate;


    /** @Column(type="string") */
    public $facebook_url;

    // * @Column(type="string") 
    // public $tickets_url;

    /** @Column(type="text") */
    public $excerpt = '';

    /** @Column(type="smallint") */
    public $status;

    /** @Column(type="datetime") */
    public $modified;


    /**
     * @BelongsTo(targetEntity="Pagekit\User\Model\User", keyFrom="user_id")
     */
    public $user;


    /** @var array */
    protected static $properties = [
        //'author' => 'getAuthor',
        'published' => 'isPublished',
        'accessible' => 'isAccessible'
    ];

    public static function getStatuses()
    {
        return [
            self::STATUS_PUBLISHED => __('Published'),
            self::STATUS_UNPUBLISHED => __('Unpublished'),
            self::STATUS_DRAFT => __('Draft'),
            self::STATUS_PENDING_REVIEW => __('Pending Review')
        ];
    }

    public function getStatusText()
    {
        $statuses = self::getStatuses();

        return isset($statuses[$this->status]) ? $statuses[$this->status] : __('Unknown');
    }

    // public function getAuthor()
    // {
    //     return $this->user ? $this->user->username : null;
    // }

    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED && $this->date < new \DateTime;
    }

    public function isAccessible(User $user = null)
    {
        return $this->isPublished() && $this->hasAccess($user ?: App::user());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = [
            'url' => App::url('@calendar/id', ['id' => $this->id ?: 0], 'base')
        ];


        return $this->toArray($data);
    }
}
