<?php
/**
 * Simple Active Record implementation for pearhunt
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Till Klampaeckel <till@php.net>
 * @copyright 2011 Till Klampaeckel
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */

/**
 * Simple active record implementation for pearhunt.
 * 
 * PHP version 5
 * 
 * @category  Utilities
 * @package   pearhunt
 * @author    Till Klampaeckel <till@php.net>
 * @copyright 2011 Till Klampaeckel
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://pear2.php.net/
 */
class Database
{
    /**
     * Create the database.
     *
     * @return void
     * @throws RuntimeException When it didn't work.
     *
     * @uses Config::getDbSettings()
     * @uses Record::getDb()
     */
    public static function create()
    {
        $settings = Config::getDbSettings();
        $db       = Record::getDb(false);

        $dbName = $db->real_escape_string($settings['dbname']);

        $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
        if ($db->query($sql) === true) {
            return;
        }
        throw new RuntimeException($db->error, $db->errno);
    }
}
