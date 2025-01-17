<?php
include_once 'User.php';
class students extends users
{

    private $connexion;

    public function __construct()
    {
        $this->connexion = $this->connect();
    }

    function dispaly_student(){
        $query = "SELECT * FROM users where role ='student' ";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    
    }

    public function Bannes($id_user , $status){

        $query = "UPDATE users SET status = :status WHERE id_user = :id_user";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam("status", $status);
        $stmt->bindParam("id_user", $id_user);
        
        try {
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            die("Erreur lors de Update status : " . $e);  
        }

    }


    public function deleteUser($id_user){

        $query = "DELETE FROM users WHERE id_user = :id_user";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(":id_user" , $id_user);
        
        try{
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            die("Erreur Lors de Suppression : " . $e);
        }

    }



}
