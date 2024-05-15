<?php 

namespace Src;

require 'config.php';

use PDO;
use PDOException;

class Database
{
    private static $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
    private static $username = DB_USER;
    private static $password = DB_PASS;
    private static $connection = null;

    public static function connect()
    {
        try {
            if (self::$connection == null) {
                self::$connection = new PDO(self::$dsn, self::$username, self::$password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } else {

                return self::$connection;
            }

            return self::$connection;
        } catch (PDOException $e) {

            echo "Connection failed:" . $e->getMessage();
        }
    }

    public static function getConnection()
    {
        return self::$connection;
    }
}