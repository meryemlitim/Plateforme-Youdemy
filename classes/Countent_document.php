<?php
include_once '../config/database.php';
include_once 'Course.php';


class content_document extends courses {

    public function __construct()
    {
        parent::__construct(); 
    }

function addCourse($title,$description,$category_name,$create_by,$type,$document_text){

        $sql = "INSERT INTO course (title , description,category_name,create_by,type ,document_text) VALUES (:title , :description , :category_name , :create_by , :type ,:document_text)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':create_by', $create_by);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':document_text', $document_text);
        $stmt->execute();
    }
}
