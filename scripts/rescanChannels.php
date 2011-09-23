<?php
require_once __DIR__ . '/../bootstrap.php';


$channels = new Channels();

foreach ($channels as $channel) {
    try {
        $channel_file = null;
        include 'updateChannel.php';
    } catch(Exception $e) {
        echo 'Error updating '.$channel->name.' '.$e.PHP_EOL;
    }
}
