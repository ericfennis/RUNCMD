<?php

return [

    /*
     * Installation hook.
     */
    'install' => function ($app) {

        $util = $app['db']->getUtility();

        if ($util->tableExists('@calendar') === false) {
            $util->createTable('@calendar', function ($table) {
                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('name', 'string', ['length' => 255, 'default' => '']);
                $table->addColumn('user_id', 'integer', ['unsigned' => true, 'length' => 10, 'default' => 0]);
                $table->addColumn('slug', 'string', ['length' => 255]);
                $table->addColumn('title', 'string', ['length' => 255]);
                $table->addColumn('status', 'smallint');
                $table->addColumn('date', 'datetime', ['notnull' => false]);
                $table->addColumn('modified', 'datetime');
                $table->addColumn('content', 'text');
                $table->addColumn('eventDate', 'datetime');
                $table->addColumn('locati', 'string');
                $table->addColumn('facebook_url', 'string');
                $table->addColumn('tickets_url', 'string');
                $table->addColumn('excerpt', 'text');
                $table->addColumn('data', 'json_array', ['notnull' => false]);
                $table->addColumn('roles', 'simple_array', ['notnull' => false]);
                $table->setPrimaryKey(['id']);
                $table->addUniqueIndex(['slug'], '@CALENDAR_EVENT_SLUG');
                $table->addIndex(['title'], '@CALENDAR_EVENT_TITLE');
                $table->addIndex(['user_id'], '@CALENDAR_EVENT_USER_ID');
                $table->addIndex(['date'], '@CALENDAR_EVENT_DATE');
            });
        }

    },


    /*
     * Uninstall hook
     *
     */
    'uninstall' => function ($app) {

        $util = $app['db']->getUtility();

        if ($util->tableExists('@calendar')) {
            $util->dropTable('@calendar');
        }

    },

    /*
     * Runs all updates that are newer than the current version.
     *
     */
    'updates' => [

        '0.5.0' => function ($app) {

        },

        '0.9.0' => function ($app) {

        },

    ],

];