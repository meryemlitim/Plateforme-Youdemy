<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";
require_once "../classes/Category.php";
require_once "../classes/Course.php";
require_once "../classes/Content_video.php";
require_once "../classes/Countent_document.php";
require_once "../classes/Enrollement.php";
require_once "../classes/Tag.php";

$course1 = new content_video();
$enrollement = new enrollement();
$tags = new tags();
$user_id = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";

if (isset($_GET['id_course'])) {

    $id_course = $_GET['id_course'];
    $getcourseDetail = $course1->getcourseDetail($id_course);
    $getcourseTag = $tags->getTagCourse($id_course);

}



if (isset($_POST['course_enrollement'])) {

    $id_course = $_POST['id_course'];
    $insertEnrollement = $enrollement->insertEnrollement($id_course, $user_id);

}


?>
<?php if ($role == 'teacher') { ?>
    <div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">

        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-8 relative h-auto"> <!-- Increased max-w-4xl for width and added h-auto -->
            <?php foreach ($getcourseDetail as $Detail) { ?>
                <h1 class="text-3xl font-bold text-blue-600 mb-4"><?= htmlspecialchars($Detail['title'] ?? '') ?></h1>
                <div class="flex gap-3 ">
                    <?php foreach ($getcourseTag as $tag_course) { ?>

                        <div class='bg-gray-400 text-white px-4 py-2 rounded-lg mb-2 inline-block hover:bg-gray-500 cursor-pointer'><?= $tag_course['tag_name'] ?></div>
                    <?php } ?>
                </div>

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

<?php } else if ($role == 'student') { ?>
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
        <div class="flex justify-center">
            <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-8 relative h-auto"> <!-- Increased max-w-4xl for width and added h-auto -->
                <?php foreach ($getcourseDetail as $Detail) { ?>
                    <div class="flex justify-between">
                        <h1 class="text-3xl font-bold text-blue-600 mb-4"><?= htmlspecialchars($Detail['title'] ?? '') ?></h1>
                        
                        <form action="" method="post">
                            <input type="hidden" name="id_course" value="<?= $Detail["id_course"]; ?>">
                            <button type="submit" name="course_enrollement"
                                class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-red-600">
                                <span class="border-r border-white pr-3">Enrollement</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 24 24">
                                    <path d="M16.707 4.293l-3.997 3.998 4.242 4.243 3.997-3.998a2 2 0 0 0 0-2.828l-2.828-2.828a2 2 0 0 0-2.828 0zM12.414 8.707L11 7.293 4 14.293V17h2.707l7.414-7.414z" />
                                </svg>

                            </button>
                        </form>

                    </div>

                    <div class="flex gap-3 ">
                    <?php foreach ($getcourseTag as $tag_course) { ?>

                        <div class='bg-gray-400 text-white px-4 py-2 rounded-lg mb-2 inline-block hover:bg-gray-500 cursor-pointer'><?= $tag_course['tag_name'] ?></div>
                    <?php } ?>
                </div>
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
    </body>

    </html>


<?php } else {
    header('location:login.php');
?>

<?php } ?>