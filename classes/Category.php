<?php
include_once '../config/database.php';

class categries extends db
{

    private $connexion;

    public function __construct()
    {
        $this->connexion = $this->connect();
    }

    function addCategory($category_name){
        $sql="INSERT INTO category(category_name) values (:category_name)";
        $stmt=$this->connexion->prepare($sql);
        $stmt->bindParam(':category_name',$category_name);
        $stmt->execute();
        

    }

    function dispaly_category(){
        $query="SELECT * FROM category ";
        $stmt=$this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function deleteCategory($id_category){
        $query="DELETE FROM category WHERE id_category = :id_category";
        $stmt=$this->connexion->prepare($query);
        $stmt->bindParam("id_category",$id_category);
        $stmt->execute();
    }


    function getId_category($id_category) {
        try {
            $sql = "SELECT * FROM category WHERE id_category = :id_category";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id_category', $id_category, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            // Handle and log the error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    function editCategory($id_category,$newCategory_name){
        $query="UPDATE category SET category_name = :newCategory_name where id_category = :id_category";
        $stmt=$this->connexion->prepare($query);
        $stmt->bindParam(':newCategory_name',$newCategory_name);
        $stmt->bindParam(':id_category',$id_category);
        $stmt->execute();
    }


    }
