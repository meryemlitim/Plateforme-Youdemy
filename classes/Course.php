<?php
include_once '../config/database.php';

abstract class courses extends db
{
    protected $connexion;

    public function __construct()
    {
        $this->connexion = $this->connect();
    }
    abstract public function addCourse($title);

    // public function addCourse($courseDetails);
    // public function displayCourses();
}

// <?php
// include_once '../config/database.php';

// class courses extends db
// { 
//     private $connexion;

//     public function __construct()
//     {
//         $this->connexion = $this->connect();
//     }

//     public function addCourse($courseDetails);
//     public function displayCourses();
// }
