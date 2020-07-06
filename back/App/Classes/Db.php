<?php

namespace App\Classes;

use PDO;
use PDOException;

class Db
{
    protected static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {

            try {
                self::$instance = new PDO(sprintf('%s:dbname=%s;host=%s',DB_DRIVER, DB_NAME, DB_HOST), DB_USER, DB_PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

            } catch (PDOException $error) {
                echo $error->getMessage();
            }

        }

        return self::$instance;
    }
}
