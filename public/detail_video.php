<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";
require_once "../classes/Category.php";
require_once "../classes/Course.php";
require_once "../classes/Content_video.php";
require_once "../classes/Countent_document.php";

$course1 = new content_video();
$user_id = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";

if(isset($_GET['id_course'])){

    $id_course=$_GET['id_course'];
    $getcourseDetail=$course1->getcourseDetail($id_course);    
  }
?>


<div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-8 relative h-auto"> <!-- Increased max-w-4xl for width and added h-auto -->
        <?php foreach ($getcourseDetail as $Detail) { ?>
            <h1 class="text-3xl font-bold text-blue-600 mb-4"><?= htmlspecialchars($Detail['title'] ?? '') ?></h1>
            <p class="text-gray-700 mb-2"><strong>Description:</strong><?= htmlspecialchars($Detail['description'] ?? '') ?></p>
            <p class="text-gray-700 mb-2"><strong>Created by:</strong> <?= htmlspecialchars($Detail['username'] ?? '') ?></p>
            <p class="text-gray-700 mb-2"><strong>Category:</strong><?= $Detail["category_name"]; ?></p>
            <p class="text-gray-700 mb-2"><strong>Date of Creation:</strong> <?= $Detail["date_creation"]; ?></p>

            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Video Content</h2>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe width="50%" height="250" src="<?= $Detail["video_url"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> <!-- Adjusted height to 500 -->
                </div>
            </div>
        <?php } ?>
    </div> 
</div>
