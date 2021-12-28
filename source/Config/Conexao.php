<?php
namespace Source\Config;
use \PDO;

class Conexao
{
    private static $instance;

    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new \PDO(
                "mysql:host=" . DATABASE_HOST . ";
                dbname=" . DATABASE_DBNAME .";charset=utf8",
                DATABASE_USER,DATABASE_PASSWORD
            );
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    } 
}