<?php
include_once '../config/database.php';

class tags extends db
{

    private $connexion;

    public function __construct()
    {
        $this->connexion = $this->connect();
    }

    
}
