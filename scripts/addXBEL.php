#!/usr/bin/env php
<?php
require_once __DIR__ . '/../bootstrap.php';

// Get the XBEL as a string
$xmlstr = file_get_contents('http://pear.php.net/channels/xbel.php');


if ($xbel = new SimpleXMLElement($xmlstr)) {

    foreach ($xbel->bookmark as $bookmark) {
        echo $bookmark->title.PHP_EOL;

        if (false === file_get_contents($bookmark->title.'/channel.xml')) {
            continue;
        }

        try {
            $channel_file = new \PEAR2\Pyrus\ChannelFile($bookmark->title.'/channel.xml', false, true);
        } catch(Exception $e) {
            echo $e->getMessage().PHP_EOL;
            continue;
        }

        if ($channel = Channel::getByName($channel_file->name)) {
            // All ok
        } else {
            $channel = new \Channel();
        }

        $channel->name        = $channel_file->name;
        $channel->alias       = $channel_file->alias;
        $channel->description = $channel_file->description;

        $channel->save();

        try {
            include __DIR__ . '/updateChannel.php';
        } catch(Exception $e) {
            echo $e->getMessage().PHP_EOL;
            continue;
        }
    }

}