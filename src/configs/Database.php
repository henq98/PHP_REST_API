<?php

namespace src\configs;

class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            try {
                self::$connection = new \PDO(
                    'mysql:host=mysql;
                    dbname=rest;
                    port=3306;
                    charset=utf8',
                    'root',
                    'admin'
                );

                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$connection;
    }
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
