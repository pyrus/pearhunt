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
    echo "addChannel.php channel\n\n";
    echo "Example: addChannel.php pear.php.net\n";
    exit(1);
}

if ($channel = Channel::getByName($_SERVER['argv'][1])) {
    echo "That channel already exists!\n";
    exit(0);
}

echo "Adding channel...\n";

$channel       = new \Channel();
$channel->name = $_SERVER['argv'][1];

if (!$channel->insert()) {
    echo 'Error creating the channel!'.PHP_EOL;
    exit(1);
}


echo "The channel {$channel->name} has been added!".PHP_EOL;

include __DIR__ . '/updateChannel.php';

exit(0);


