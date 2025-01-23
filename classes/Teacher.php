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


        if ($result["isvalide"] == 0) {
            return false;
        } else {
            return true;
        }
    }

    function valide_teacher($id_teacher)
    {
        $sql = "UPDATE teacher SET isvalide = true where id_teacher =:id_teacher";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':id_teacher', $id_teacher);
        // $stmt->bindParam(':isvalide',$isvalide);
        try {

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Erreur Lors Modification : " . $e);
        }
    }



    function dispaly_teacher()
    {
        $query = "SELECT * FROM users JOIN teacher ON users.id_user = teacher.id_teacher WHERE users.role = 'teacher' ORDER BY teacher.isvalide = false DESC";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function Bannes($id_user, $status)
    {

        $query = "UPDATE users SET status = :status WHERE id_user = :id_user";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam("status", $status);
        $stmt->bindParam("id_user", $id_user);

        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            die("Erreur lors de Update status : " . $e);
        }
    }


    public function deleteTeacher($id_user)
    {

        $query = "DELETE FROM users WHERE id_user = :id_user";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(":id_user", $id_user);

        try {
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            die("Erreur Lors de Suppression : " . $e);
        }
    }

    function topTeacher()
    {
        $sql = "SELECT 
    t.id_teacher,
    u.username AS teacher_name,
    COUNT(e.id_enrollment) AS total_enrollments
FROM 
    teacher t
JOIN 
    users u ON t.id_teacher = u.id_user
JOIN 
    course c ON t.id_teacher = c.create_by 
LEFT JOIN 
    enrollment e ON c.id_course = e.id_course
GROUP BY 
    t.id_teacher, u.username 
ORDER BY 
    total_enrollments DESC 
LIMIT 3; 
";
        $stmt = $this->connexion->prepare($sql);

        $stmt->execute();
        $rst = $stmt->fetchall();
        return $rst;
    }
}

// $teacher = new teachers(); 
// echo $teacher->isvalide(4);