<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 12/11/18
 * Time: 14:24
 */

namespace restaurant\model\frontEnd;


class Manager
{
protected function dbConnect(){
    /* when @ school*/
    $servername = "127.0.0.1";
    $username = "root";
    $password = "troiswa";
    $charset = 'utf8';
    $database = "restaurant";
    try {
        $bdd = new \PDO("mysql:host=$servername;dbname=$database;charset=$charset", $username, $password);
        // set the PDO error mode to exception
        $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $bdd;

    /* when @ home
    $servername = "localhost";
    $port = "3308";
    $username = "root";
    $password = "";
    $database = "restaurant";
    $charset = 'utf8';
    try {
        $bdd = new \PDO("mysql:host=$servername;port=$port;dbname=$database;charset=$charset", $username, $password);
        // set the PDO error mode to exception
        $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch(\PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $bdd;*/

}

}