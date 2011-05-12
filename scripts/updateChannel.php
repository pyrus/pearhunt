#!/usr/bin/env php
<?php
if (file_exists(dirname(__FILE__).'/../config.inc.php')) {
    require_once dirname(__FILE__).'/../config.inc.php';
} else {
    require_once dirname(__FILE__).'/../config.sample.php';
}

if (!isset($_SERVER['argv'], $_SERVER['argv'][1])
    || $_SERVER['argv'][1] == '--help' || $_SERVER['argc'] != 2) {
    echo "This program requires 1 argument.\n";
    echo "updateChannel.php channel\n\n";
    echo "Example: updateChannel.php pear.php.net\n";
    exit(1);
}

$channel = Channel::getByName($_SERVER['argv'][1]);

if (false === $channel) {
    echo "That channel does not exist!\n";
    exit(1);
}

foreach ($channel->getPackages() as $package) {
	$package->save();
}

