<?php

use Illuminate\Database\Capsule\Manager as DB;

$database = new DB;

$database->addConnection([
	'driver' => $_ENV['DATABASE_DRIVER'],
	'host' => $_ENV['DATABASE_HOST'],
	'database' => $_ENV['DATABASE_DATABASE'],
	'username' => $_ENV['DATABASE_USERNAME'],
	'password' => $_ENV['DATABASE_PASSWORD'],
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$database->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$database->bootEloquent();

