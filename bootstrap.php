<?php
if (file_exists(__DIR__ . '/etc/config.inc.php')) {
    require_once __DIR__ . '/etc/config.inc.php';
} else {
    require_once __DIR__ . '/etc/config.sample.php';
}
