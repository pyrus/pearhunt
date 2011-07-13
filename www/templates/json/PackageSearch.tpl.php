<?php
if (count($context)) {
    foreach ($context as $package) {
        echo '"'.$package->name.'":'.json_encode($package->toArray()).','.PHP_EOL;
    }
}