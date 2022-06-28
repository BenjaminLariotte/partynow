<?php

// Définition de constantes globales
define('DB_HOST', 'db5000215523.hosting-data.io');
define('DB_NAME', 'dbs210439');
define('DB_USER', 'dbu230970');
define('DB_PASS', 'Sixfois6etNeuffois9!!!');


class DataBase
{
    private static $database;

    // Méthode pour créer une connection à la BDD
    public static function databaseConnect()
    {
        if(empty(self::$database))
        {
            self::$database = new PDO
            (
                "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",
                DB_USER, DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        }
        return self::$database;
    }

    // Méthode pour éxécuter une réquète SQL
    public static function databaseRequest($sql, $parameters=null)
    {
        $result = false;
        try
        {
            $statement = self::databaseConnect()->prepare($sql);
            $statement->execute($parameters);
            $count = $statement->rowCount();
            $result = $statement->fetchAll();
        }
        catch (Exception $exception)
        {
            die($exception->getMessage());
        }
        $statement = null;
        return $result;
    }

    // Méthode pour récupérer le dernier ID crée dans la BDD
    public static function databaseLastId()
    {
        return self::databaseConnect()->lastInsertId();
    }
}
