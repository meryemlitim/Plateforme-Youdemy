<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";


$user = new users();
$teacher = new teachers(); 

$user_id = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";

$isValide=$teacher->isvalide($user_id );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


</head>
<body>
  <?php if($role=="teacher"){ ?> 
    <?php include "../template/header_teacher.php" ?>
<h1>hello teacher</h1>
<?php if(!$isValide){?>
    <h1>you need admin validation</h1>
    <?php } else{?>
        <h1>admin has been validate your account</h1>
        <?php } ?>
<?php } else {?> 
    <?php include "404_page.php" ?>

<?php } ?>



    
</body>
 

    
</body>

<script>
    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
      if (collapseMenu.style.display === 'block') {
        collapseMenu.style.display = 'none';
      } else {
        collapseMenu.style.display = 'block';
      }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);
  </script>
</html>