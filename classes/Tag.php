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
            $stmt->bindParam(':id_tag', $id_tag, PDO::PARAM_INT); // Ensure the parameter type matches
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() for a single row
        } catch (PDOException $e) {
            // Handle and log the error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // function editTag($id_tag, $newTag_name) {
    //     try {
    //         $query = "UPDATE tag SET tag_name = :newTag_name WHERE id_tag = :id_tag";
    //         $stmt = $this->connexion->prepare($query);
    
    //         // Bind the parameters
    //         $stmt->bindParam(':newTag_name', $newTag_name, PDO::PARAM_STR); // Bind newTag_name
    //         $stmt->bindParam(':id_tag', $id_tag, PDO::PARAM_INT); // Bind id_tag
    
    //         // Execute the statement
    //         $stmt->execute();
    
    //         // Optional: Return true for success
    //         return true;
    
    //     } catch (PDOException $e) {
    //         // Handle errors
    //         echo "Error: " . $e->getMessage();
    //         return false;
    //     }
    // }
    
    
}
