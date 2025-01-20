<?php
include_once '../config/database.php';
include_once 'Course.php';


class content_video extends courses
{

    // public function __construct()
    // {
    //     $this->connexion = $this->connect(); 
    // }

    public function __construct()
    {
        parent::__construct(); 
    }

    function addCourse($title,$description,$category_name,$create_by,$type,$video_url){

        $sql = "INSERT INTO course (title , description,category_name,create_by,type ,video_url) VALUES (:title , :description , :category_name , :create_by , :type ,:video_url)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':create_by', $create_by);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':video_url', $video_url);
        $stmt->execute();
    }
    function displayCourse($user_id){
        $query="SELECT * FROM course WHERE type = 'video' and create_by=$user_id";
        $stmt=$this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function delete_course($id_course){
        $query="DELETE FROM course WHERE id_course = :id_course";
        $stmt=$this->connexion->prepare($query);
        $stmt->bindParam("id_course",$id_course);
        $stmt->execute();
    }


    function getcourseDetail($id_course){
        $query = "SELECT * FROM course where id_course=:id_course";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam('id_course',$id_course);
        $stmt->execute();

        return $stmt->fetchAll();
    }


function editCourse($id_course,$title, $description, $category_name, $video_url){
    $query="UPDATE course SET title = :title , description= :description ,category_name= :category_name ,video_url= :video_url  where id_course = :id_course";
    $stmt=$this->connexion->prepare($query);
    $stmt->bindParam(':id_course', $id_course);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category_name', $category_name);
    $stmt->bindParam(':video_url', $video_url);
    $stmt->execute();
}










    }

    