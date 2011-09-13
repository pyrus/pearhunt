<?php
require_once __DIR__ . '/../bootstrap.php';


$channels = new Channels();

foreach ($channels as $channel) {
    try {
        include 'updateChannel.php';
    } catch(Exception $e) {
        echo 'Error updating '.$channel->name.PHP_EOL;
    }
}
