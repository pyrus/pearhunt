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

if (!isset($channel)) {
    $channel = Channel::getByName($_SERVER['argv'][1]);
}

if (false === $channel) {
    echo "That channel does not exist!\n";
    exit(1);
}

if (!isset($channel_file)) {
    $channel_file = new \PEAR2\Pyrus\ChannelFile($channel->name, false, true);
}

$pyrus_channel = new \PEAR2\Pyrus\Channel($channel_file);

// Ensure the channel currently exists in the registry
$config = \PEAR2\Pyrus\Config::current();
if (!$config->channelregistry->exists($pyrus_channel->name)) {
	// Add it
    $config->channelregistry->add($pyrus_channel);
}

// Get the list of remote packages
$packages = new \PEAR2\Pyrus\Channel\RemotePackages($config->channelregistry[$pyrus_channel->name]);


foreach ($packages as $remote_package) {
	// Check if we know about this package already
    if (false === $package = Package::getByChannelAndName($channel, (string)$remote_package->name)) {
        $package = new Package();
    }

    // Update all the info
    $package->channel_id  = $channel->id;
    $package->name        = $remote_package->name;
    $package->description = $remote_package->description;
    if ($package->save()) {
    	echo ' -'.$channel->name.'/'.$remote_package->name.PHP_EOL;
    }
}

