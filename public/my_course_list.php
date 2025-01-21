<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";
require_once "../classes/Category.php";
require_once "../classes/Course.php";
require_once "../classes/Content_video.php";
require_once "../classes/Countent_document.php";

$user_id = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";

  if (isset($_GET['id_course'])) {


    echo $id_course = $_GET['id_course'];

}


?>