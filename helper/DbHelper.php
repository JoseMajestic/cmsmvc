<?php

namespace App\Helper;

/*
* Class DbHelper
*
* This class represents a database helper for connecting to a MySQL database using PDO.
* It provides a construtor that establishes a connection to the database and sets the error mode to exception.
*
* @package App\Helper
*
*/

class DbHelper
{

    public $db;

    function __construct()
    {
        // conexión mediante PDO
        // $opcions = [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAME utf-8"]; // obsoleto < PHP 8-*
        $opcions = [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"];

        try {
            $this->db = new \PDO(
                'mysql:host=localhost; dbname=cmsmvc',
                'root',
                '',
                $opcions
            );
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Fallou a conexión: ' . $e->getMessage();
        }
    }
}
