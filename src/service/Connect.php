<?php 
namespace service;

class Connect {

    /**
     *
     * @var DB 
     */
    protected static $db = null;

    public static function setDB(array $database) {
        try {
            $options = [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
            $pdo = new \PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'], 
                    $database['username'], 
                    $database['password'], 
                    $options
            );

            self::$db = $pdo;
            
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * getDB
     * 
     * @return PDO
     */
    public static function getDB() {
        return self::$db;
    }

    /**
     * deconnect termine la connexion à la base de données
     * 
     * @return null
     */
    public static function deconnect() {
        self::$db = null;
    }

}