<?php

class SQL {
    private $pdo;

    function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=bulletin', 'root', null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}