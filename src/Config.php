<?php
class Config
{
	protected static $db_settings = array(
        'host'     => 'localhost',
        'user'     => 'pearhunt',
        'password' => 'pearhunt',
        'dbname'   => 'pearhunt'
    );

    public static function setDbSettings($settings = array())
    {
        self::$db_settings = $settings + self::$db_settings;
    }

    public static function getDbSettings()
    {
        if (empty(self::$db_settings)) {
            self::setDbSettings();
        }

        return self::$db_settings;
    }
}