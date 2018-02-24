<?php

namespace SpencerMortensen\Autoloader;

$project = dirname(__DIR__);

$classes = array(
	'SpencerMortensen\\RegularExpressions' => 'src'
);

require "{$project}/vendor/spencer-mortensen/autoloader/src/Autoloader.php";

new Autoloader($project, $classes);
