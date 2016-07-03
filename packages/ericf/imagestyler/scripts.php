<?php

use Doctrine\DBAL\Schema\Comparator;

return [

    'install' => function ($app) {

		$util = $app['db']->getUtility();

		if ($util->tableExists('@imagestyler') === false) {
			$util->createTable('@imagestyler', function ($table) {
				$table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
				$table->addColumn('style', 'json_array', ['notnull' => false]);
				$table->setPrimaryKey(['id']);
			});
		}

    },

    'uninstall' => function ($app) {

        $util = $app['db']->getUtility();

        if ($util->tableExists('@imagestyler')) {
            $util->dropTable('@imagestyler');
        }
		// remove the config
		$app['config']->remove('ericf/imagestyler');

	}

];