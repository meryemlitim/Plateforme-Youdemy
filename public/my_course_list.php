<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";
require_once "../classes/Category.php";
require_once "../classes/Course.php";
require_once "../classes/Content_video.php";
require_once "../classes/Countent_document.php";
require_once "../classes/Enrollement.php";

$id_user = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";
$enrollement = new enrollement();

$get_myCourse = $enrollement->get_my_enrolled_course($id_user);
// print_r($get_myCourse);



?>
<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  </head>


  <body>
    <?php include "../template/header_user.php" ?>
<?php if ($role == 'student') { ?>
  
    <div class="container py-5 px-8"> <!-- Increased padding on container -->
      <div class="flex justify-center mb-5">
        <div class="w-full lg:w-2/3">
          <div class="text-center relative mb-5">
            <h6 class="inline-block text-secondary uppercase pb-2">My Enrolled Courses</h6>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($get_myCourse as $myCourse) { ?>
          <!-- <form method="post"> -->
          <div class=" course_detail relative pb-4 w-3/4 mx-auto ">
            <a class="relative block overflow-hidden mb-2"
              <?php if ($myCourse['type'] == 'video') { ?>
              href="detail_video.php?id_course=<?= $myCourse['id_course'] ?>"
              <?php } else { ?>
              href="detail_document.php?id_course=<?= $myCourse['id_course'] ?>"

              <?php } ?>>
              <img class="w-full h-auto" src="https://cdn.vectorstock.com/i/thumb-large/27/08/avatar-woman-and-learning-online-concept-vector-28092708.jpg" alt=""> <!-- Image width reduced -->
              <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                <h4 class="text-center"><?= htmlspecialchars($myCourse['title'] ?? '') ?></h4>
                <div class="border-t mt-3">
                  <div class="flex justify-between p-4">
                    <span><i class="fa fa-user mr-2"></i><?= htmlspecialchars($myCourse['username'] ?? '') ?></span>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!-- </form> -->
        <?php } ?>


      </div>

    </div>

 
<?php } else {?>
  <?php include "404_page.php" ?>


<?php } ?>
</body>

</html>
