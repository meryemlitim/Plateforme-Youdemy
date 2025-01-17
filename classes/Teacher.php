<?php
include_once 'User.php';
class teachers extends users
{

    private $connexion;

    public function __construct()
    {
        $this->connexion = $this->connect();
    }
    function insert_teacher($id_teacher)
    {
        $sql = "SELECT * FROM teacher where id_teacher =:id_teacher";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute(['id_teacher' => $id_teacher]);
        $result = $stmt->fetch();

        if (!$result) {
            $query = "INSERT INTO teacher(id_teacher) VALUES (:id_teacher)";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindParam(':id_teacher', $id_teacher);

            try {
                $stmt->execute();
                return 'Register Succeful';
            } catch (PDOException $e) {

                die("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
            }
        } else {
            return false;
        }
    }

    function isvalide($id_teacher)
    {
        $sql = "SELECT isvalide From teacher where id_teacher =:id_teacher";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute(['id_teacher' => $id_teacher]);
        $result = $stmt->fetch();
        

        if($result["isvalide"]==0){
            return false;
        }else{
            return true;
        }
    }



    function dispaly_teacher(){
        $query = "SELECT * FROM users where role ='teacher' ";
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


    public function deleteTeacher($id_user){

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

// $teacher = new teachers(); 
// echo $teacher->isvalide(4);