<?php
include_once '../config/database.php';

class enrollement extends db 
{

    private $connexion;
    // protected $id_course;
    // protected $id_student;

    public function __construct()
    {
        $this->connexion = $this->connect();
       
    }

    

function insertEnrollement($id_course,$id_user){  
    // $sql="INSERT INTO enrollment(id_course,id_user) VALUES (:id_course ,:id_user)";
    // $stmt=$this->connexion->prepare($sql);
    // $stmt->bindParam('id_course',$id_course);
    // $stmt->bindParam('id_user',$id_user);
    // $stmt->execute();

    $sql="SELECT * FROM enrollment WHERE id_course = :id_course and id_user = :id_user";
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindParam('id_course',$id_course);
    $stmt->bindParam('id_user',$id_user);
    $stmt->execute();
    $rst= $stmt->fetch();
    if(!$rst){
        $sql="INSERT INTO enrollment(id_course,id_user) VALUES (:id_course ,:id_user)";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam('id_course',$id_course);
        $stmt->bindParam('id_user',$id_user);
        $stmt->execute();

    }
}

function get_my_enrolled_course($id_user){
    $sql="SELECT * 
    FROM enrollment
    JOIN users ON users.id_user = enrollment.id_user
    JOIN course ON course.id_course = enrollment.id_course where enrollment.id_user=:id_user;
    ";
    $stmt=$this->connexion->prepare($sql);
    $stmt->bindParam('id_user', $id_user);
    $stmt->execute();
    return $stmt->fetchAll();
}


function totalEnrollement(){
    $sql="SELECT COUNT(*) AS total FROM enrollment";
    $stmt=$this->connexion->prepare($sql);
    $stmt->execute();
    $rst=$stmt->fetch();
    return $rst['total'];
}
function topCourse(){
    $sql="SELECT 
course.id_course,
course.title,
COUNT(enrollment.id_enrollment) AS total
FROM course
JOIN enrollment ON enrollment.id_course=course.id_course
GROUP BY course.title, course.id_course
ORDER BY total DESC
LIMIT 1;";
    $stmt=$this->connexion->prepare($sql);

    $stmt->execute();
    $rst=$stmt->fetch();
    return $rst['title'];
}




}
