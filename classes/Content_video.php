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

    function addCourse($title){
        $sql = "INSERT INTO course (title) VALUES (:title)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
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
?>