<?php
include_once '../config/database.php';

class tags extends db
{

    private $connexion;

    public function __construct()
    {
        $this->connexion = $this->connect();
    }

    function addTag($tag_name){
        $sql="INSERT INTO tag(tag_name) values (:tag_name)";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam(':tag_name',$tag_name);
        $stmt->execute();
        

    }

    function dispaly_tag(){
        $query="SELECT * FROM tag ";
        $stmt=$this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function deleteTag($id_tag){
        $query="DELETE FROM tag WHERE id_tag = :id_tag";
        $stmt=$this->connexion->prepare($query);
        $stmt->bindParam("id_tag",$id_tag);
        $stmt->execute();
    }

    function editTag($id_tag,$newTag_name){
        $query="UPDATE tag SET tag_name = :newTag_name where id_tag = :id_tag";
        $stmt=$this->connexion->prepare($query);
        $stmt->bindParam(':newTag_name',$newTag_name);
        $stmt->bindParam(':id_tag',$id_tag);
        $stmt->execute();
    }

    // function getId_tag($id_tag){
    //     $sql="SELECT * FROM tag WHERE id_tag=:id_tag";
    //     $stmt=$this->connexion->prepare($sql);
    //     $stmt->bindParam(':id_tag',$id_tag);
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }

    function getId_tag($id_tag) {
        try {
            $sql = "SELECT * FROM tag WHERE id_tag = :id_tag";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id_tag', $id_tag, PDO::PARAM_INT); 
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    function display_tag(){
        $sql="SELECT * FROM tag";
        $stmt=$this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    function insertTagCourse($id_course,$id_tag){
        $sql="INSERT INTO tag_course(id_course ,id_tag ) VALUES (:id_course , :id_tag)";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam('id_course',$id_course);
        $stmt->bindParam('id_tag',$id_tag);
        $stmt->execute();


    }

    function getTagCourse($id_course){
        $sql="SELECT tag_name FROM tag_course
              join course on course.id_course=tag_course.id_course
              join tag on tag.id_tag=tag_course.id_tag 
              where course.id_course=:id_course";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam('id_course',$id_course);

        $stmt->execute();
        return $stmt->fetchAll();

    }
    
}
