<?php

namespace Model;

abstract class Connect{

    const HOST = "localhost";
    const DB = "cinema_yuly";
    const USER = "root";
    const PASS = "";

    public static function seConnecter() {
         try
    {
        return new \PDO('mysql:host='.self::HOST.';dbname='.self::DB.';charset=utf8', self::USER, self::PASS, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }
        catch (\PDOException $ex)
    {
        return $ex->getMessage();
    }
    }
}

   

    
