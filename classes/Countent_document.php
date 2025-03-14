<?php
include_once '../config/database.php';
include_once 'Course.php';


class content_document extends courses {

    public function __construct()
    {
        parent::__construct(); 
    }

function addCourse($title,$description,$id_category,$create_by,$type,$document_text){

        $sql = "INSERT INTO course (title , description,id_category,create_by,type ,document_text) VALUES (:title , :description , :id_category , :create_by , :type ,:document_text)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':create_by', $create_by);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':document_text', $document_text);
        $stmt->execute();
    }
    function displayCourse($user_id){
        $query="SELECT * FROM course WHERE type = 'document'and create_by=$user_id";
        $stmt=$this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function editCourse($id_course,$title, $description, $id_category, $document_text){
        $query="UPDATE course SET title = :title , description= :description ,id_category= :id_category ,document_text= :document_text  where id_course = :id_course";
        $stmt=$this->connexion->prepare($query);
        $stmt->bindParam(':id_course', $id_course);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':document_text', $document_text);
        $stmt->execute();
    }

    function getId_course(){
        $lastCourseId = $this->connexion->lastInsertId();
        return $lastCourseId;
      }
    

}
