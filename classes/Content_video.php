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

    // // Method to add a video course
    // public function addCourse($courseDetails)
    // {
    //     try {
    //         $sql = "INSERT INTO course (title, description, id_category, type, create_by) 
    //                 VALUES (:title, :description, :id_category, 'video', :create_by)";
    //         $stmt = $this->connexion->prepare($sql);
    //         $stmt->bindParam(':title', $courseDetails['title']);
    //         $stmt->bindParam(':description', $courseDetails['description']);
    //         $stmt->bindParam(':id_category', $courseDetails['id_category']);
    //         $stmt->bindParam(':create_by', $courseDetails['create_by']);
    //         $stmt->execute();

    //         return $this->connexion->lastInsertId(); // Returns the ID of the inserted course
    //     } catch (PDOException $e) {
    //         echo "Error adding course: " . $e->getMessage();
    //         return false;
    //     }
    // }

    
    // public function displayCourses()
    // {
    //     try {
    //         $sql = "SELECT * FROM course WHERE type = 'video'";
    //         $stmt = $this->connexion->prepare($sql);
    //         $stmt->execute();

    //         return $stmt->fetchAll(); // Fetch all video courses
    //     } catch (PDOException $e) {
    //         echo "Error fetching courses: " . $e->getMessage();
    //         return [];
    //     }
    // }
}
