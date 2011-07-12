<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include 'phar://'.__DIR__.'/../vendor/PEAR2_Pyrus-2.0.0a3.phar/PEAR2_Pyrus-2.0.0a3/php/PEAR2/Autoload.php';

function autoload($class)
{
    $class = str_replace('_', '/', $class);
    include $class . '.php';
}

PEAR2\Autoload::initialize(__DIR__ . '/../vendor/php');

spl_autoload_register("autoload");

set_include_path(__DIR__ . '/../src');


$config = \PEAR2\Pyrus\Config::singleton('/tmp');
$config->preferred_state = 'alpha';


