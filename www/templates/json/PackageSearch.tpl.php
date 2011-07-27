<?php
if (count($context)) {
    foreach ($context as $package) {
        echo '"'.$package->channel.'/'.$package->name.'":'.json_encode($package->toArray()).','.PHP_EOL;
    }
}