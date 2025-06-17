<?php

class BD
{
    const BD_HOST = "localhost";
    const BD_USER = "root";
    const BD_PASS = "";
    const BD_NAME = "ifto";

    static function getConnection()
    {
        $conn = new PDO('mysql:host=' . self::BD_HOST . ';dbname=' . self::BD_NAME, self::BD_USER, self::BD_PASS);
        return $conn;
    }
}