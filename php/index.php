<?php

// Load up composer autoload, and instantiate the application.
require 'vendor/autoload.php';
$config = (require 'config.php');

$app = new \Slim\Slim;

// Regsiter a singleton of the Mustache engine, and tell it to cache
$app->container->singleton('mustache', function () {
	return new Mustache_Engine(array(
		'cache' => 'storage/mustache',
		'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/template')
	));
});

// Helper functiont to render templates
function renderTemplate($name, $data = array()) {
	global $app, $config;

	$data += array(
		'currentRoute' => $app->router()->getCurrentRoute(),
		'baseUrl' => $config['baseUrl'] . 'index.php',
		'baseDir' => $config['baseUrl'],
	);

	return $app->mustache->loadTemplate($name)->render($data);
}

// Route to the homepage...
$app->get('/', function () {
	echo renderTemplate('index');
});

// Terms of Service
$app->get('/terms', function () {
	echo renderTemplate('terms');
});

// FAQ Page
$app->get('/faq', function () {
	echo renderTemplate('faq');
});

// IRC chat
$app->get('/irc', function () {
	echo renderTemplate('irc');
});

// IRC chat
$app->get('/careers', function () {
	echo renderTemplate('careers');
});

// AJAX for stats on the homepage
$app->get('/stats', function () {
	global $config;

	function getStat() {
		global $config;

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
				return new PDO($config['driver'] . ':host=' . $config['host'] . ';dbname=' . $db, $config['username'], $config['password']);
			}

			// Create the database connections
			$whmcs = makeConnection($config['database'], 'whmcs');
			$multicraft = makeConnection($config['database'], 'multicraft_daemon');

			// Get the number of clients...
			$results = $whmcs->query('SELECT COUNT(*) as  n FROM `tblclients`')->fetchAll();
			$clients = $results[0]['n'];

			
			// Get the number of players...
			$results = $multicraft->query('SELECT COUNT(*) as  n FROM `player`')->fetchAll();
			$players = $results[0]['n'];
			
			
			// Get the total RAM
			$results = $multicraft->query('SELECT SUM(`memory`) as n FROM `server`')->fetchAll();
			$ram = round($results[0]['n'] / 1024);

			// And le results!
			$data = compact('clients', 'players', 'ram');

			// Store that in the cache and return it
			$cache->set('stats', $data);
			return $data;
		}
	}

	echo json_encode(getStat());
});

// Run the application!
$app->run();