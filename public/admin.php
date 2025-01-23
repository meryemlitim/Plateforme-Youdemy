<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";
require_once "../classes/Student.php";
require_once "../classes/Tag.php";
require_once "../classes/Category.php";
require_once "../classes/Enrollement.php";
require_once "../classes/Course.php";
require_once "../classes/Content_video.php";
require_once "../classes/Countent_document.php";


$user = new users();
$teacher = new teachers();
$student = new students();
$tag = new tags();
$category = new categries();
$enrollement = new enrollement();
$course = new content_video();

$user_id = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";

$all_student = $student->dispaly_student();
$all_teacher = $teacher->dispaly_teacher();
$all_tag = $tag->dispaly_tag();
$total_student = $user->studentTotalNumber();
$total_teacher = $user->teacherTotalNumber();
$total_enrollement = $enrollement->totalEnrollement();
$topCourse = $enrollement->topCourse();
$total_course = $course->totalCourseNumber();
$topTeacher=$teacher->topTeacher();

if (isset($_POST["status"])) {

    $status = $_POST["status"];
    $id_user = $_POST["user_id"];

    if ($status == "on") {

        $blocked = "blocked";
        $student->Bannes($id_user, $blocked);
        header("Location:admin.php");
    } else if ($status == "off") {

        $unblocked = "unblocked";
        $student->Bannes($id_user, $unblocked);
        header("Location:admin.php");
    }
}


if (isset($_POST["delete"])) {

    $id_user = $_POST["user_id"];

    $result = $student->deleteUser($id_user);

    if ($result) {
        header("Location:admin.php");
    } else {
        echo $result;
    }
}
if (isset($_POST['valideBtn'])) {
    $id_teacher = $_POST['valideBtn'];
    $isValide = $teacher->valide_teacher($id_teacher);
    if (!$isValide) {
        header("location: admin.php?failure");
    }
}
// ----------------TAG---------------

if (isset($_POST['add_tag_btn'])) {
    $tag_name = trim($_POST['tag']);
    $tag_name2 = array_map('trim', explode(',', $tag_name));
    foreach ($tag_name2 as $tg) {
        if (!empty($tg)) {
            $tag->addTag($tg);
        }
    }
    header("location:admin.php");
}

if (isset($_POST['deleteTag'])) {
    $id_tag = $_POST['id_tag'];
    $tag->deleteTag($id_tag);
    header("location:admin.php");
}
if (isset($_POST['Tag_edit'])) {
    // header("location:admin.php?done");
    $id_tag = $_POST['id_tag_edit'];
    $update_tag = $tag->getId_tag($id_tag);
    include "edit_tag.php";


    // header("location:admin.php");

}

if (isset($_POST['update_tag'])) {
    $id_tag = $_POST['update_tag'];
    $newTag_name = $_POST['newTag_name'];


    $rst = $tag->editTag($id_tag, $newTag_name);
    if (!$rst) {
        header("location:admin.php?failure");
    }
}

// ---------------CATEGORY-------------------
if (isset($_POST['add_category_btn'])) {
    $category_name = $_POST['category'];
    $category->addCategory($category_name);
    header("location:admin.php");
}

$all_category = $category->dispaly_category();

if (isset($_POST['deleteCategory'])) {
    $id_category = $_POST['id_category'];
    $category->deleteCategory($id_category);
    header("location:admin.php");
}


if (isset($_POST['category_edit'])) {
    // header("location:admin.php?done");
    $id_category = $_POST['id_category_edit'];
    $update_category = $category->getId_category($id_category);
    include "edit_category.php";


    // header("location:admin.php");

}

if (isset($_POST['update_category'])) {
    $id_category = $_POST['update_category'];
    $newCategory_name = $_POST['newCategory_name'];


    $rst = $category->editCategory($id_category, $newCategory_name);
    if (!$rst) {
        header("location:admin.php?failure");
    }
}
// -------get course by category------------
if(isset($_POST['getCourse'])){
    $category_name=$_POST['cat'];
    $getcourseByCat=$course-> getCourseByCategory($category_name);
    include("getcourseByCat.php");
    // print_r($getcourseByCat);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php if ($role == "admin") { ?>
        <div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
            <div class="flex items-start">




                <?php include "../template/sidebare.php" ?>
                <section class="main-content w-full px-8">

                    <?php include "../template/header_admin.php" ?>
                    <!-- -------------------------------admin home----------------------------- -->
                    <section id="admin_home">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex items-center">
                                    <div class="p-3 bg-pink-500 rounded-full text-white">
                                        <svg class="w-[50px] h-[50px] fill-[#ffffff]" viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">

                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9v28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5V291.9c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z"></path>

                                        </svg>



                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-700">Total Student</h4>
                                        <p class="text-2xl font-bold text-gray-900"><?= $total_student ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex items-center">
                                    <div class="p-3 bg-green-500 rounded-full text-white">
                                        <svg class="w-[50px] h-[50px] fill-[#ffffff]" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">

                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M224 256A128 128 0 1 1 224 0a128 128 0 1 1 0 256zM209.1 359.2l-18.6-31c-6.4-10.7 1.3-24.2 13.7-24.2H224h19.7c12.4 0 20.1 13.6 13.7 24.2l-18.6 31 33.4 123.9 36-146.9c2-8.1 9.8-13.4 17.9-11.3c70.1 17.6 121.9 81 121.9 156.4c0 17-13.8 30.7-30.7 30.7H285.5c-2.1 0-4-.4-5.8-1.1l.3 1.1H168l.3-1.1c-1.8 .7-3.8 1.1-5.8 1.1H30.7C13.8 512 0 498.2 0 481.3c0-75.5 51.9-138.9 121.9-156.4c8.1-2 15.9 3.3 17.9 11.3l36 146.9 33.4-123.9z"></path>

                                        </svg>


                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-700">Total Teacher</h4>
                                        <p class="text-2xl font-bold text-gray-900"><?= $total_teacher ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex items-center">
                                    <div class="p-3 bg-yellow-500 rounded-full text-white">
                                        <svg class="w-[50px] h-[50px] fill-[#ffffff]" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">

                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"></path>

                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-700">Total Enrollement</h4>
                                        <p class="text-2xl font-bold text-gray-900"><?= $total_enrollement ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex items-center">
                                    <div class="p-3 bg-red-500 rounded-full text-white">
                                        <svg class="w-[50px] h-[50px] fill-[#ffffff]" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">

                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path d="M249.6 471.5c10.8 3.8 22.4-4.1 22.4-15.5V78.6c0-4.2-1.6-8.4-5-11C247.4 52 202.4 32 144 32C93.5 32 46.3 45.3 18.1 56.1C6.8 60.5 0 71.7 0 83.8V454.1c0 11.9 12.8 20.2 24.1 16.5C55.6 460.1 105.5 448 144 448c33.9 0 79 14 105.6 23.5zm76.8 0C353 462 398.1 448 432 448c38.5 0 88.4 12.1 119.9 22.6c11.3 3.8 24.1-4.6 24.1-16.5V83.8c0-12.1-6.8-23.3-18.1-27.6C529.7 45.3 482.5 32 432 32c-58.4 0-103.4 20-123 35.6c-3.3 2.6-5 6.8-5 11V456c0 11.4 11.7 19.3 22.4 15.5z"></path>

                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-700">Total Course</h4>
                                        <p class="text-2xl font-bold text-gray-900"><?= $total_course ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 p-6">
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex items-center">

                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-700">The Course with The most Students</h4>
                                        <p class="text-2xl font-bold text-gray-900"><?= $topCourse ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex items-center">

                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-700">Top Three Teacher</h4>
                                        <?php foreach($topTeacher as $top){?>
                                            <p class="text-2xl font-bold text-gray-900"><?= $top['teacher_name'] ?></p>

                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </section>


                    <!--------------------------------------------- STUDENT MANAGEMENT ---------------------------------------------------------->

                    <section id="user" class="flex flex-col items-center bg-gray-50 min-h-screen p-6 hidden">
                        <!-- Header -->
                        <div class="w-full max-w-7xl bg-white shadow-lg rounded-lg p-6 space-y-6">
                            <div class="flex justify-between items-center">
                                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                                    STUDENT MANAGEMENT
                                </h1>

                            </div>

                            <!-- Table -->
                            <div class="font-[sans-serif] overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="whitespace-nowrap">
                                        <tr>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                user id
                                            </th>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Name
                                            </th>

                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Blocked
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 fill-gray-400 inline cursor-pointer ml-2"
                                                    viewBox="0 0 401.998 401.998">
                                                    <path
                                                        d="M73.092 164.452h255.813c4.949 0 9.233-1.807 12.848-5.424 3.613-3.616 5.427-7.898 5.427-12.847s-1.813-9.229-5.427-12.85L213.846 5.424C210.232 1.812 205.951 0 200.999 0s-9.233 1.812-12.85 5.424L60.242 133.331c-3.617 3.617-5.424 7.901-5.424 12.85 0 4.948 1.807 9.231 5.424 12.847 3.621 3.617 7.902 5.424 12.85 5.424zm255.813 73.097H73.092c-4.952 0-9.233 1.808-12.85 5.421-3.617 3.617-5.424 7.898-5.424 12.847s1.807 9.233 5.424 12.848L188.149 396.57c3.621 3.617 7.902 5.428 12.85 5.428s9.233-1.811 12.847-5.428l127.907-127.906c3.613-3.614 5.427-7.898 5.427-12.848 0-4.948-1.813-9.229-5.427-12.847-3.614-3.616-7.899-5.42-12.848-5.42z"
                                                        data-original="#000000" />
                                                </svg>
                                            </th>
                                            <!-- <th class="p-4 text-left text-sm font-semibold text-black">
                      Action
                    </th> -->
                                        </tr>
                                    </thead>

                                    <tbody class="whitespace-nowrap">


                                        <?php foreach ($all_student as $student) { ?>

                                            <tr class="odd:bg-gray-100">
                                                <td class="p-4 text-md font-bold">
                                                    <?= $student["id_user"]; ?>
                                                </td>
                                                <td class="p-4 text-sm">
                                                    <div class="flex items-center cursor-pointer w-max">
                                                        <img src='https://cdn2.iconfinder.com/data/icons/circle-avatars-1/128/050_girl_avatar_profile_woman_suit_student_officer-512.png' class="w-9 h-9 rounded-full shrink-0" />
                                                        <div class="ml-4">
                                                            <p class="text-sm text-black"> <?= $student["username"]; ?> </p>
                                                            <p class="text-xs text-gray-500 mt-0.5"><?= $student["email"]; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td class="p-4 text-sm text-black">

                        <form action="admin.php" method="POST">
                          <input type="hidden" name="user_id" value="<?= $User["user_id"]; ?>">
                          <select name="role" onchange="this.form.submit()" class="mt-1 block w-3/6 p-2 border rounded-md bg-white text-gray-700 focus:ring focus:ring-orange-300">
                            <option value="admin" <?= $User["role"] == "admin" ? "selected" : ""  ?>>Admin</option>
                            <option value="user" <?= $User["role"] == "user" ? "selected" : ""  ?>>User</option>
                          </select>
                        </form>

                      </td> -->
                                                <td class="p-4">

                                                    <form action="admin.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?= $student["id_user"]; ?>">
                                                        <input type="hidden" name="status" value="off">
                                                        <label class="relative cursor-pointer">
                                                            <input type="checkbox" onchange="this.form.submit()" name="status" value="<?= $student["status"] === "blocked" ? "on" : "off" ?>" class="sr-only peer" <?= $student["status"] === "blocked" ? "checked" : "" ?> />
                                                            <div
                                                                class="w-11 h-6 flex items-center bg-gray-300 rounded-full peer peer-checked:after:translate-x-full after:absolute after:left-[2px] peer-checked:after:border-white after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                                                            </div>
                                                        </label>
                                                    </form>

                                                </td>
                                                <td class="p-4">

                                                    <form action="admin.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?= $student["id_user"]; ?>">
                                                        <button type="submit" name="delete"
                                                            class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">
                                                            <span class="border-r border-white pr-3">Delete</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 320.591 320.591">
                                                                <path
                                                                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                                                    data-original="#000000" />
                                                                <path
                                                                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                                                    data-original="#000000" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>


                                        <?php } ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <!----------------------------------------------- END STUDENT MANAGEMENT ----------------------------------------------------------->


                    <!--------------------------------------------- TEACHER MANAGEMENT ---------------------------------------------------------->

                    <section id="teacher" class="flex flex-col items-center bg-gray-50 min-h-screen p-6 hidden">
                        <!-- Header -->
                        <div class="w-full max-w-7xl bg-white shadow-lg rounded-lg p-6 space-y-6">
                            <div class="flex justify-between items-center">
                                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                                    TEACHER MANAGEMENT
                                </h1>

                            </div>

                            <!-- Table -->
                            <div class="font-[sans-serif] overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="whitespace-nowrap">
                                        <tr>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Teacher id
                                            </th>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Name
                                            </th>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Validation
                                            </th>

                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Blocked
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 fill-gray-400 inline cursor-pointer ml-2"
                                                    viewBox="0 0 401.998 401.998">
                                                    <path
                                                        d="M73.092 164.452h255.813c4.949 0 9.233-1.807 12.848-5.424 3.613-3.616 5.427-7.898 5.427-12.847s-1.813-9.229-5.427-12.85L213.846 5.424C210.232 1.812 205.951 0 200.999 0s-9.233 1.812-12.85 5.424L60.242 133.331c-3.617 3.617-5.424 7.901-5.424 12.85 0 4.948 1.807 9.231 5.424 12.847 3.621 3.617 7.902 5.424 12.85 5.424zm255.813 73.097H73.092c-4.952 0-9.233 1.808-12.85 5.421-3.617 3.617-5.424 7.898-5.424 12.847s1.807 9.233 5.424 12.848L188.149 396.57c3.621 3.617 7.902 5.428 12.85 5.428s9.233-1.811 12.847-5.428l127.907-127.906c3.613-3.614 5.427-7.898 5.427-12.848 0-4.948-1.813-9.229-5.427-12.847-3.614-3.616-7.899-5.42-12.848-5.42z"
                                                        data-original="#000000" />
                                                </svg>
                                            </th>

                                        </tr>
                                    </thead>

                                    <tbody class="whitespace-nowrap">


                                        <?php foreach ($all_teacher as $teacher) { ?>

                                            <tr class="odd:bg-gray-100">
                                                <td class="p-4 text-md font-bold">
                                                    <?= $teacher["id_user"]; ?>
                                                </td>
                                                <td class="p-4 text-sm">
                                                    <div class="flex items-center cursor-pointer w-max">
                                                        <img src='https://cdn2.iconfinder.com/data/icons/circle-avatars-1/128/050_girl_avatar_profile_woman_suit_student_officer-512.png' class="w-9 h-9 rounded-full shrink-0" />
                                                        <div class="ml-4">
                                                            <p class="text-sm text-black"> <?= $teacher["username"]; ?> </p>
                                                            <p class="text-xs text-gray-500 mt-0.5"><?= $teacher["email"]; ?></p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="p-4 flex items-center gap-3">
                                                    <p>
                                                    <div class="flex items-center gap-4">
                                                        <?php
                                                        if ($teacher["isvalide"]) {

                                                            echo "valide";
                                                        ?>
                                                            <button type="submit" class="p-2 rounded-full bg-green-600 text-white hover:bg-green-700 active:bg-green-600 focus:outline-none">
                                                                <i class="fas fa-check-circle text-sm"></i>
                                                            </button>
                                                    </div>
                                                <?php

                                                        } else {
                                                            echo "invalide";
                                                ?>
                                                    <form action="" method="post">
                                                        <button name="valideBtn" value="<?= $teacher["id_user"]; ?>" type="submit" class="p-2 rounded-full bg-red-600 text-white hover:bg-red-700 active:bg-green-600 focus:outline-none">
                                                            <i class="fas fa-check-circle text-sm"></i>
                                                        </button>
                                                    </form>
                                                <?php
                                                        }
                                                ?>
                                                </p>

                                                </td>
                                                <td class="p-4">

                                                    <form action="admin.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?= $teacher["id_user"]; ?>">
                                                        <input type="hidden" name="status" value="off">
                                                        <label class="relative cursor-pointer">
                                                            <input type="checkbox" onchange="this.form.submit()" name="status" value="<?= $teacher["status"] === "blocked" ? "on" : "off" ?>" class="sr-only peer" <?= $teacher["status"] === "blocked" ? "checked" : "" ?> />
                                                            <div
                                                                class="w-11 h-6 flex items-center bg-gray-300 rounded-full peer peer-checked:after:translate-x-full after:absolute after:left-[2px] peer-checked:after:border-white after:bg-white after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500">
                                                            </div>
                                                        </label>
                                                    </form>

                                                </td>
                                                <!-- --------- -->

                                                <td class="p-4">

                                                    <form action="admin.php" method="POST">
                                                        <input type="hidden" name="user_id" value="<?= $teacher["id_user"]; ?>">
                                                        <button type="submit" name="delete"
                                                            class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">
                                                            <span class="border-r border-white pr-3">Delete</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 320.591 320.591">
                                                                <path
                                                                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                                                    data-original="#000000" />
                                                                <path
                                                                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                                                    data-original="#000000" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>


                                        <?php } ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <!----------------------------------------------- END TEACHER MANAGEMENT ----------------------------------------------------------->
                    <!----------------------------------------------- TAGS MANAGEMENT ----------------------------------------------------------->

                    <section id="tag" class="flex flex-col items-center bg-gray-50 min-h-screen p-6 hidden">
                        <!-- Header -->
                        <div class="w-full max-w-7xl bg-white shadow-lg rounded-lg p-6 space-y-6">
                            <div class="flex justify-between items-center">
                                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                                    TAGS MANAGEMENT
                                </h1>
                                <form action="" method="post">
                                    <button id="ajoutBtn" type="button" name="add_tag"
                                        class="px-5 py-2.5 rounded-full text-white text-sm tracking-wider font-medium border border-current outline-none bg-red-700 hover:bg-red-800 active:bg-red-700">
                                        ADD TAG</button>
                                </form>
                            </div>

                            <div class="font-[sans-serif] overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="whitespace-nowrap">
                                        <tr>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Tag id
                                            </th>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Tag Name
                                            </th>




                                        </tr>
                                    </thead>

                                    <tbody class="whitespace-nowrap">


                                        <?php foreach ($all_tag as $tag) { ?>

                                            <tr class="odd:bg-gray-100">
                                                <td class="p-4 text-md font-bold">
                                                    <?= $tag["id_tag"]; ?>
                                                </td>
                                                <td class="p-4 text-sm">
                                                    <div class="flex items-center cursor-pointer w-max">
                                                        <div class="ml-4">
                                                            <p class="text-sm text-black"> <?= $tag["tag_name"]; ?> </p>
                                                        </div>
                                                    </div>
                                                </td>




                                                <td class="p-4">

                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id_tag_edit" value="<?= $tag["id_tag"]; ?>">
                                                        <button type="submit" name="Tag_edit"
                                                            class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-red-600">
                                                            <span class="border-r border-white pr-3">Edit</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 24 24">
                                                                <path d="M16.707 4.293l-3.997 3.998 4.242 4.243 3.997-3.998a2 2 0 0 0 0-2.828l-2.828-2.828a2 2 0 0 0-2.828 0zM12.414 8.707L11 7.293 4 14.293V17h2.707l7.414-7.414z" />
                                                            </svg>

                                                        </button>
                                                    </form>

                                                </td>
                                                <td class="p-4">

                                                    <form action="admin.php" method="POST">
                                                        <input type="hidden" name="id_tag" value="<?= $tag["id_tag"]; ?>">
                                                        <button type="submit" name="deleteTag"
                                                            class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">
                                                            <span class="border-r border-white pr-3">Delete</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 320.591 320.591">
                                                                <path
                                                                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                                                    data-original="#000000" />
                                                                <path
                                                                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                                                    data-original="#000000" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>


                                        <?php } ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>


                    <!----------------------------------------------- CATEGORIES MANAGEMENT ----------------------------------------------------------->

                    <section id="category" class="flex flex-col items-center bg-gray-50 min-h-screen p-6 hidden">
                        <!-- Header -->
                        <div class="w-full max-w-7xl bg-white shadow-lg rounded-lg p-6 space-y-6">
                            <div class="flex justify-between items-center">
                                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                                    CATEGORIES MANAGEMENT
                                </h1>
                                <form action="" method="post">
                                    <button id="ajoutBtn_category" type="button" name="add_category"
                                        class="px-5 py-2.5 rounded-full text-white text-sm tracking-wider font-medium border border-current outline-none bg-red-700 hover:bg-red-800 active:bg-red-700">
                                        ADD CATEGORY</button>
                                </form>
                            </div>

                            <div class="font-[sans-serif] overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="whitespace-nowrap">
                                        <tr>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Category id
                                            </th>
                                            <th class="p-4 text-left text-sm font-semibold text-black">
                                                Category Name
                                            </th>




                                        </tr>
                                    </thead>

                                    <tbody class="whitespace-nowrap">


                                        <?php foreach ($all_category as $category) { ?>

                                            <tr class="odd:bg-gray-100">
                                                <td class="p-4 text-md font-bold">
                                                    <?= $category["id_category"]; ?>
                                                </td>
                                                <td class="p-4 text-sm">
                                                    <div class="flex items-center cursor-pointer w-max">
                                                        <div class="ml-4">
                                                            <p class="text-sm text-black"> <?= $category["category_name"]; ?> </p>
                                                        </div>
                                                    </div>
                                                </td>




                                                <td class="p-4">

                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id_category_edit" value="<?= $category["id_category"]; ?>">
                                                        <button type="submit" name="category_edit"
                                                            class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-red-600">
                                                            <span class="border-r border-white pr-3">Edit</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 24 24">
                                                                <path d="M16.707 4.293l-3.997 3.998 4.242 4.243 3.997-3.998a2 2 0 0 0 0-2.828l-2.828-2.828a2 2 0 0 0-2.828 0zM12.414 8.707L11 7.293 4 14.293V17h2.707l7.414-7.414z" />
                                                            </svg>

                                                        </button>
                                                    </form>

                                                </td>
                                                <td class="p-4">

                                                    <form action="admin.php" method="POST">
                                                        <input type="hidden" name="id_category" value="<?= $category["id_category"]; ?>">
                                                        <button type="submit" name="deleteCategory"
                                                            class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-red-600 hover:bg-red-700 active:bg-red-600">
                                                            <span class="border-r border-white pr-3">Delete</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 320.591 320.591">
                                                                <path
                                                                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                                                    data-original="#000000" />
                                                                <path
                                                                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                                                    data-original="#000000" />
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>


                                        <?php } ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <section id="course" class="flex flex-col items-center gap-5 bg-gray-50 min-h-screen p-6 hidden">
                        <?php foreach ($all_category as $category) { ?>
                            <div class="w-full max-w-7xl bg-white shadow-lg rounded-lg p-6 space-y-6">
                                <div class="flex justify-between items-center">
                                    <h1 class="text-1xl font-bold text-gray-800 flex items-center gap-2">
                                        <?= $category['category_name'] ?></h1>
                                    <form action="admin.php" method="POST">
                                        <input type="hidden" name="cat" value="<?= $category['category_name'] ?>">
                                        <button type="submit" name="getCourse"
                                            class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-red-600">
                                            <span class=" pr-3">Show Courses</span>
                                            <h1>hhh</h1>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>

                    </section>
                </section>

            </div>
        </div>

        <!----------------------------------------------- ADD TAG ----------------------------------------------------------->
        <div id="add_tag" class="fixed inset-0 p-4 hidden flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
            <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
                <div class="flex items-center">
                    <h3 class="text-blue-600 text-3xl font-bold flex-1 text-center w-full">ADD TAGS</h3>

                    <div id="close1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500"
                            viewBox="0 0 320.591 320.591">
                            <path
                                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                data-original="#000000"></path>
                            <path
                                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                data-original="#000000"></path>
                        </svg>
                    </div>

                </div>

                <form class="space-y-4 mt-8" action="admin.php" method="post" autocomplete="off">

                    <div>
                        <!-- <label class="text-gray-800 text-sm mb-2 block">Titre</label> -->
                        <input type="text" name="tag" placeholder="write tag here..."
                            class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                    </div>
                    <div class="flex justify-end gap-4 !mt-8">
                        <button type="button" id="ajouteCancelQuiz"
                            class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit" id="ajoutQuizBtn" name="add_tag_btn"
                            class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
                    </div>


                </form>
            </div>
        </div>


        <!----------------------------------------------- END ADD TAG ----------------------------------------------------------->




        <!----------------------------------------------- ADD CATEGORY ----------------------------------------------------------->
        <div id="add_category" class="fixed inset-0 p-4 hidden flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
            <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
                <div class="flex items-center">
                    <h3 class="text-blue-600 text-3xl font-bold flex-1 text-center w-full">ADD CATEGORY</h3>

                    <div id="close2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500"
                            viewBox="0 0 320.591 320.591">
                            <path
                                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                data-original="#000000"></path>
                            <path
                                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                data-original="#000000"></path>
                        </svg>
                    </div>

                </div>

                <form class="space-y-4 mt-8" action="admin.php" method="post" autocomplete="off">

                    <div>
                        <!-- <label class="text-gray-800 text-sm mb-2 block">Titre</label> -->
                        <input type="text" name="category" placeholder="write category here..."
                            class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                    </div>
                    <div class="flex justify-end gap-4 !mt-8">
                        <button type="button" id="ajouteCancelQuiz"
                            class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit" id="ajoutQuizBtn" name="add_category_btn"
                            class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
                    </div>


                </form>
            </div>
        </div>


        <!-- --------------------------------------------- END ADD CATEGORY --------------------------------------------------------- --> -->




        </section>

        </div>
        </div>




    <?php } else { ?>
        <?php include "404_page.php" ?>

    <?php } ?>

</body>
<script>
    let dashboardBtn = document.getElementById("dashboardBtn");
    let dashboard = document.getElementById("admin_home");
    let user = document.getElementById("user");
    let course = document.getElementById("course");
    // let teacher = document.getElementById("teacher");
    let userBtn = document.getElementById("userBtn");
    let tagBtn = document.getElementById("tagBtn");
    let categoryBtn = document.getElementById("categoryBtn");
    let courseBtn = document.getElementById("courseBtn");
    let teacher = document.getElementById("teacher");
    let tag = document.getElementById("tag");
    let category = document.getElementById("category");
    let GameBtn = document.getElementById("GameBtn");
    // let edit_tag = document.getElementById("edit_tag");



    dashboardBtn.addEventListener("click", () => {

        user.style.display = "none";
        dashboard.style.display = "flex";
        dashboard.style.flexDirection = "column";
        teacher.style.display = "none";
        tag.style.display = "none";
        course.style.display = "none";

        category.style.display = "none";

    });


    userBtn.addEventListener("click", () => {

        user.style.display = "flex";
        dashboard.style.display = "none";
        teacher.style.display = "none";
        tag.style.display = "none";
        category.style.display = "none";
        course.style.display = "none";



    });
    courseBtn.addEventListener("click", () => {

        user.style.display = "none";
        dashboard.style.display = "none";
        teacher.style.display = "none";
        tag.style.display = "none";
        category.style.display = "none";
        course.style.display = "flex";



    });

    GameBtn.addEventListener("click", () => {

        teacher.style.display = "flex";
        dashboard.style.display = "none";
        user.style.display = "none";
        tag.style.display = "none";
        category.style.display = "none";
        course.style.display = "none";



    });

    tagBtn.addEventListener("click", () => {
        tag.style.display = "flex";
        dashboard.style.display = "none";
        user.style.display = "none";
        teacher.style.display = "none";
        category.style.display = "none";
        course.style.display = "none";


    });
    categoryBtn.addEventListener("click", () => {
        category.style.display = "flex";
        dashboard.style.display = "none";
        user.style.display = "none";
        teacher.style.display = "none";
        tag.style.display = "none";
        course.style.display = "none";


    });


    // userBtn.addEventListener("click", () => {

    //   user.style.display = "flex";
    //   dashboard.style.display = "none";
    //   Game.style.display = "none";

    // });

    let artcile = document.querySelector(".artcile");

    let add_tag = document.getElementById("add_tag");
    let ajoutBtn = document.getElementById("ajoutBtn");


    // let edit_tag = document.getElementById("edit_tag");
    // let editBtn = document.getElementById("editBtn");


    let clsoe1 = document.getElementById("close1");
    let clsoe2 = document.getElementById("close2");

    ajoutBtn.addEventListener("click", () => {

        add_tag.classList.remove("hidden");
        add_tag.classList.add("flex");

    });


    let add_category = document.getElementById("add_category");
    let ajoutBtn_category = document.getElementById("ajoutBtn_category");

    ajoutBtn_category.addEventListener("click", () => {

        add_category.classList.remove("hidden");
        add_category.classList.add("flex");

    });


    // editBtn.addEventListener("click", () => {

    //     edit_tag.classList.remove("hidden");
    //     edit_tag.classList.add("flex");

    // });


    close1.addEventListener("click", () => {

        add_tag.classList.remove("flex");
        add_tag.classList.add("hidden");

    });

    close2.addEventListener("click", () => {

        add_category.classList.remove("flex");
        add_category.classList.add("hidden");

    });
</script>


</html>