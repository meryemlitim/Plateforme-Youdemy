<?php
include_once '../config/database.php';

class enrollement extends db
{

    private $connexion;
    private $id_course;
    private $id_student;

    public function __construct()
    {
        $this->connexion = $this->connect();
        $this->id_course=$this->id_course;
        $this->id_student=$this->id_student;
    }


function insertEnrollement($id_course,$id_student){  

}





}
