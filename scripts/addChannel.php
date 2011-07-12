#!/usr/bin/env php
<?php
require_once __DIR__ . '/../bootstrap.php';

if (!isset($_SERVER['argv'], $_SERVER['argv'][1])
    || $_SERVER['argv'][1] == '--help' || $_SERVER['argc'] != 2) {
    echo "This program requires 1 argument." . PHP_EOL;
    echo "addChannel.php channel" . PHP_EOL . PHP_EOL;
    echo "Example: addChannel.php pear.php.net" . PHP_EOL;
    exit(1);
}

if ($channel = Channel::getByName($_SERVER['argv'][1])) {
    echo "That channel already exists!" . PHP_EOL;
} else {
	$channel = new \Channel();
}

echo "Adding channel..." . PHP_EOL;


$pyrus_channel = new Remote_PyrusChannel($_SERVER['argv'][1]);

$channel->name        = $pyrus_channel->getName();
$channel->alias       = $pyrus_channel->getAlias();
$channel->description = $pyrus_channel->getDescription();

if (!$channel->save()) {
    echo 'Error creating the channel!'.PHP_EOL;
    exit(1);
}

echo "The channel {$channel->name} has been added!".PHP_EOL;

include __DIR__ . '/updateChannel.php';

exit(0);


