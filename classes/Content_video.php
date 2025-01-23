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

    function addCourse($title, $description, $id_category, $create_by, $type, $video_url)
    {

        $sql = "INSERT INTO course (title , description,id_category,create_by,type ,video_url) VALUES (:title , :description , :id_category , :create_by , :type ,:video_url)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':create_by', $create_by);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':video_url', $video_url);
        $stmt->execute();
    }
    function displayCourse($user_id)
    {
        $query = "SELECT * FROM course WHERE type = 'video' and create_by=$user_id";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function delete_course($id_course)
    {
        $query = "DELETE FROM course WHERE id_course = :id_course";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam("id_course", $id_course);
        $stmt->execute();
    }


    function getcourseDetail($id_course)
    {
        $query = "SELECT * 
FROM course
JOIN users ON users.id_user = course.create_by
JOIN category ON category.id_category = course.id_category
WHERE id_course = :id_course;
";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam('id_course', $id_course);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    function allCourses()
    {
        $query = "SELECT * FROM course join users on users.id_user=course.create_by ";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    function editCourse($id_course, $title, $description, $id_category, $video_url)
    {
        $query = "UPDATE course SET title = :title , description= :description ,id_category= :id_category ,video_url= :video_url  where id_course = :id_course";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':id_course', $id_course);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':video_url', $video_url);
        $stmt->execute();
    }

    function getId_course()
    {
        $lastCourseId = $this->connexion->lastInsertId();
        return $lastCourseId;
    }

    // ---------------------------------search-----------------------------------------------
    public function getCoursWithPagination($search, $limit, $offset)
    {
        $sql = "SELECT * FROM course join users on users.id_user=course.create_by ";
        $params = [];

        if (!empty($search)) {
            $sql .= " WHERE title LIKE :search OR description LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        $sql .= " ORDER BY title ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->connexion->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if (!empty($search)) {
            $stmt->bindValue(':search', $params['search'], PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countCours($search)
    {
        $sql = "SELECT COUNT(*) as total FROM course";
        $params = [];

        if (!empty($search)) {
            $sql .= " WHERE title LIKE :search OR description LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        $stmt = $this->connexion->prepare($sql);

        if (!empty($search)) {
            $stmt->bindValue(':search', $params['search'], PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }


    function totalCourseNumber()
    {
        $sql = "SELECT COUNT(*) AS total FROM course";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        $rst = $stmt->fetch();
        return $rst['total'];
    }
    function total_course($id_user)
    {
        $sql = "SELECT COUNT(*) AS total FROM course join users on id_user=course.create_by where users.id_user = :id_user";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);

        $stmt->execute();

        $rst = $stmt->fetch();
        return $rst['total'];
    }

    function getCourseByCategory($category_name)
    {
        $sql = "SELECT * FROM course where category_name = :category_name";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam('category_name', $category_name);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
