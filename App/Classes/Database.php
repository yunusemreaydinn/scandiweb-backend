<?php

define('SERVER', 'localhost');
define('DATABASE', 'scandiweb');
define('USERNAME', 'root');
define('PASSWORD', '');

class Database {
    public function connection()
    {
        $dsn = 'mysql:host=' . SERVER . ';dbname=' . DATABASE; //data source name
        $pdo = new PDO($dsn, USERNAME, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}