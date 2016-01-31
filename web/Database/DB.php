<?php
namespace RosyMoth\Database;

use PDO;

class DB
{
    public static function getInstance()
    {
        //todo: set up a less privileged user and use it here
        return self::getAdminInstance();
    }

    public static function getAdminInstance()
    {
        $settings = parse_ini_file('/home/mareofni/rosymothconfig/config.ini');
        return new PDO(
            'mysql:host=localhost;dbname='.$settings['dbName'],
            $settings['adminUser'],
            $settings['adminPassword']
        );
    }

}