#!/usr/bin/env php
<?php
require_once __DIR__ . '/../bootstrap.php';

if (!isset($_SERVER['argv'], $_SERVER['argv'][1])
    || $_SERVER['argv'][1] == '--help' || $_SERVER['argc'] != 2) {
    echo "This program requires 1 argument." . PHP_EOL;
    echo "addChannel.php channel" . PHP_EOL . PHP_EOL;
    echo "Example: addChannel.php http://pear.php.net/channel.xml" . PHP_EOL;
    exit(1);
}

$channel_file = new \PEAR2\Pyrus\ChannelFile($_SERVER['argv'][1], false, true);

if ($channel = Channel::getByName($channel_file->name)) {
    echo "That channel already exists!" . PHP_EOL;
} else {
	$channel = new \Channel();
}

echo "Adding channel..." . PHP_EOL;

$channel->name        = $channel_file->name;
$channel->alias       = $channel_file->alias;
$channel->description = $channel_file->description;

if (!$channel->save()) {
    echo 'Error creating the channel!' . PHP_EOL;
    exit(1);
}

echo "The channel {$channel->name} has been added!" . PHP_EOL;

include __DIR__ . '/updateChannel.php';

exit(0);


