<?php

// Load up composer autoload, and instantiate the application.
require 'vendor/autoload.php';

$app = new \Slim\Slim;

$database = array(
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'username'  => 'root',
	'password'  => 'your-password',
);

// Regsiter a singleton of the Mustache engine, and tell it to cache
$app->container->singleton('mustache', function () {
	return new Mustache_Engine(array(
		'cache' => 'storage/mustache'
	));
});

// Helper functiont to render templates
function renderTemplate($name, $data = array()) {
	$data['currentRoute'] = $app->router()->getCurrentRoute();
	$tpl = $app->mustache->loadTemplate('template/' + $name);
	return $tpl->render($data);
}

// Route to the homepage...
$app->get('/', function ($name) {
	renderTemplate($index);
});

// AJAX for stats on the homepage
$app->get('/stats', function ($name) {


	function getStat() {
		// Load the caching system
		$cacheDir = 'storage/stats';
		$adapter = new Desarrolla2\Cache\Adapter\File($cacheDir);
		$adapter->setOption('ttl', 60 * 60);
		$cache = new Desarrolla2\Cache\Cache($adapter);

		if ($cache->has('stats')) {
			return $cache->get('stats');
		} else {

			// Helper function to make a database connection
			function makeConnection($config, $db) {
				return new PDO($config['driver'] + ':host=' + $config['host'] + ';dbname=' + $db, $config['username'], $config['password']);
			}

			// Create the database connections
			$whmcs = makeConnection($database, 'whmcs');
			$multicraft = makeConnection($database, 'multicraft_daemon');

			// Get the number of clients...
			$results = $whmcs->query('SELECT COUNT(*) as  n FROM `tblclients`');
			$clients = $results[0]['n'];

			
			// Get the number of players...
			$results = $multicraft->query('SELECT COUNT(*) as  n FROM `player`');
			$players = $results[0]['n'];
			
			
			// Get the total RAM
			$results = $multicraft->query('SELECT SUM(`memory`) as n FROM `server`');
			$ram = round($results[0]['n'] / 1024);

			// And le results!
			$data = compact('clients', 'players', 'ram');

			// Store that in the cache and return it
			$cache->set('stats', $data);
			return $data;
		}
	}

	return json_encode(getStat());
});

// Run the application!
$app->run();