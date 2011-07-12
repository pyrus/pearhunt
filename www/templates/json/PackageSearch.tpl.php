<?php
if (is_array($context) && !empty($context)) {
    foreach ($context as $package) {
	    echo '"'.$package->name.'":'.json_encode($package->toArray()).','.PHP_EOL;
    }
}
