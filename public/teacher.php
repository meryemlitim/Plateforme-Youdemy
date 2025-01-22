<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";
require_once "../classes/Category.php";
require_once "../classes/Tag.php";
require_once "../classes/Course.php";
require_once "../classes/Content_video.php";
require_once "../classes/Countent_document.php";


$user = new users();
$teacher = new teachers();
$category = new categries();
$tags = new tags();

$all_category = $category->dispaly_category();
$all_tags = $tags->display_tag();


$user_id = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";

$isValide = $teacher->isvalide($user_id);
$course1 = new content_video();
$course = new content_document();

$videoCourses = $course1->displayCourse($user_id);
$documentCourses = $course->displayCourse($user_id);

if (isset($_POST['add_courses_video'])) {
  $type = 'video';
  $title = $_POST['course_title'];
  $description = $_POST['course_description'];
  $video_url = $_POST['course_content_video'];
  $create_by = $user_id;
  $category_name = $_POST['course_category'];

  $course1->addCourse($title, $description, $category_name, $create_by, $type, $video_url);
  $id_course=$course1->getId_course();
  if(!empty($_POST['tags'])){
    foreach($_POST['tags'] as $id_tag){
     $tags->insertTagCourse($id_course,$id_tag);

    }
  }
  header("location:teacher.php");
}
if (isset($_POST['add_courses_document'])) {
  $type = 'document';
  $title = $_POST['course_title'];
  $description = $_POST['course_description'];
  $document_text = $_POST['course_content_document'];
  $create_by = $user_id;
  $category_name = $_POST['course_category'];
 
  $course->addCourse($title, $description, $category_name, $create_by, $type, $document_text);
  $id_course=$course->getId_course();
  if(!empty($_POST['tags'])){
    foreach($_POST['tags'] as $id_tag){
     $tags->insertTagCourse($id_course,$id_tag);

    }
  }
  header("location:teacher.php");
}
// ------------------delete--------------
if (isset($_POST['deleteCourse'])) {
  $id_course = $_POST['id_course'];
  $course1->delete_course($id_course);
}

// -----------edit video-----------

if (isset($_POST['course_video_edit'])) {
  $id_course = $_POST['id_course'];
  $getcourseDetail = $course1->getcourseDetail($id_course);

  include "video_edit.php";
}

if (isset($_POST['edit_courses_video'])) {
  $id_course = $_POST['id_course'];
  $title = $_POST['course_title'];
  $description = $_POST['course_description'];
  $video_url = $_POST['course_content_video'];
  $category_name = $_POST['course_category'];
  $course1->editCourse($id_course, $title, $description, $category_name, $video_url);
  header("location:teacher.php");
}
// -----------edit document-----------

if (isset($_POST['course_document_edit'])) {
  $id_course = $_POST['id_course'];
  $getcourseDetail = $course1->getcourseDetail($id_course);

  include "document_edit.php";
}

if (isset($_POST['edit_courses_document'])) {
  $id_course = $_POST['id_course'];
  $title = $_POST['course_title'];
  $description = $_POST['course_description'];
  $document_text = $_POST['course_content_document'];
  $category_name = $_POST['course_category'];
  $course->editCourse($id_course, $title, $description, $category_name, $document_text);
  header("location:teacher.php");
} 

if (isset($_POST['course_video_detail'])) {
  $id_course = $_POST['id_course'];
  $getcourseDetail = $course1->getcourseDetail($id_course);
  $getcourseTag = $tags->getTagCourse($id_course);
  include "detail_video.php";
  // header("location:detail_video.php");


}
if (isset($_POST['course_document_detail'])) {
  $id_course = $_POST['id_course'];
  $getcourseDetail = $course1->getcourseDetail($id_course);
  $getcourseTag = $tags->getTagCourse($id_course);

  include "detail_document.php";
  // header("location:detail_video.php");


}
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
  <?php if ($role == "teacher") { ?>
    <div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
      <div class="flex items-start">
        <?php include "../template/teacher_sidebare.php" ?>
        <section class="main-content w-full px-8">
          <?php include "../template/header_admin.php" ?>
          <!-- ---------------------------------courses-------------------------------- -->
          <section id="course" class="flex flex-col items-center bg-gray-50 min-h-screen p-6 hidden">
            <!-- Header -->
            <div class="w-full max-w-7xl bg-white shadow-lg rounded-lg p-6 space-y-6">
              <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                  COURSES MANAGEMENT
                </h1>

                <form action="" method="post">
                  <select name="course_type" id="ajoutBtn_course"
                    class="px-5 py-2.5 rounded-full text-white text-sm tracking-wider font-medium border border-current outline-none bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-600">
                    <option value="" disabled selected style="background: white; color: black;">ADD COURSE</option>
                    <option value="video" style="background: white; color: black;">Video</option>
                    <option value="document" style="background: white; color: black;">Document</option>
                  </select>
                </form>


              </div>

              <div class="font-[sans-serif] overflow-x-auto">
                <table class="min-w-full bg-white">
                  <thead class="whitespace-nowrap">
                    <tr>
                      <th class="p-4 text-left text-sm font-semibold text-black">
                        course id
                      </th>
                      <th class="p-4 text-left text-sm font-semibold text-black">
                        course Title
                      </th>
                      <th class="p-4 text-left text-sm font-semibold text-black">
                        course Type
                      </th>




                    </tr>
                  </thead>

                  <tbody class="whitespace-nowrap">


                    <?php foreach ($videoCourses as $course) { ?>

                      <tr class="odd:bg-gray-100">
                        <td class="p-4 text-md font-bold">
                          <?= $course["id_course"]; ?>
                        </td>
                        <td class="p-4 text-sm">
                          <div class="flex items-center cursor-pointer w-max">
                            <div class="ml-4">

                              <p class="text-sm text-black"> <?= $course["title"]; ?> </p>
                            </div>
                          </div>
                        </td>

                        <td class="p-4 text-sm">
                          <div class="flex items-center cursor-pointer w-max">
                            <div class="ml-4">
                              <p class="text-sm text-black"> <?= $course["type"]; ?> </p>
                            </div>
                          </div>
                        </td>





                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="course_video_detail"
                              class="px-4 py-2 flex items-center justify-center gap-2 rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-red-600">
                              <span class="border-r border-white pr-3">Detail</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                              </svg>


                            </button>
                          </form>

                        </td>
                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="course_video_edit"
                              class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-red-600">
                              <span class="border-r border-white pr-3">Edit</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 24 24">
                                <path d="M16.707 4.293l-3.997 3.998 4.242 4.243 3.997-3.998a2 2 0 0 0 0-2.828l-2.828-2.828a2 2 0 0 0-2.828 0zM12.414 8.707L11 7.293 4 14.293V17h2.707l7.414-7.414z" />
                              </svg>

                            </button>
                          </form>

                        </td>
                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="deleteCourse"
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
                    <?php foreach ($documentCourses as $course) { ?>

                      <tr class="odd:bg-gray-100">
                        <td class="p-4 text-md font-bold">
                          <?= $course["id_course"]; ?>
                        </td>
                        <td class="p-4 text-sm">
                          <div class="flex items-center cursor-pointer w-max">
                            <div class="ml-4">
                              <p class="text-sm text-black"> <?= $course["title"]; ?> </p>
                            </div>
                          </div>
                        </td>
                        <td class="p-4 text-sm">
                          <div class="flex items-center cursor-pointer w-max">
                            <div class="ml-4">
                              <p class="text-sm text-black"> <?= $course["type"]; ?> </p>
                            </div>
                          </div>
                        </td>

                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="course_document_detail"
                              class="px-4 py-2 flex items-center justify-center gap-2 rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-red-600">
                              <span class="border-r border-white pr-3">Detail</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                              </svg>
                            </button>
                          </form>

                        </td>
                        <td class="p-4">

                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="course_document_edit"
                              class="px-4 py-2 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-red-600">
                              <span class="border-r border-white pr-3">Edit</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="11px" fill="currentColor" class="ml-3 inline" viewBox="0 0 24 24">
                                <path d="M16.707 4.293l-3.997 3.998 4.242 4.243 3.997-3.998a2 2 0 0 0 0-2.828l-2.828-2.828a2 2 0 0 0-2.828 0zM12.414 8.707L11 7.293 4 14.293V17h2.707l7.414-7.414z" />
                              </svg>

                            </button>
                          </form>

                        </td>
                        <td class="p-4">
                          <form action="" method="POST">
                            <input type="hidden" name="id_course" value="<?= $course["id_course"]; ?>">
                            <button type="submit" name="deleteCourse"
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


          <!-- ---------------------------------END courses-------------------------------- -->

          <!----------------------------------------------- ADD courses VIDEO ----------------------------------------------------------->
          <div id="add_courses_video" class="fixed inset-0 p-4 hidden flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
            <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
              <?php if ($isValide) { ?>
                <div class="flex items-center">
                  <h3 class="text-blue-600 text-3xl font-bold flex-1 text-center w-full">ADD COURES</h3>

                  <div id="close3">
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

                <form class="space-y-4 mt-8" action="" method="post" autocomplete="off">
                  <div>
                    <label class="text-gray-800 text-sm mb-2 block">Titre</label>
                    <input type="text" name="course_title" placeholder="write tag here..."
                      class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                  </div>

                  <div>
                    <label class="text-gray-800 text-sm mb-2 block">Description</label>
                    <input type="text" name="course_description" placeholder="write tag here..."
                      class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                  </div>
                  <div>
                    <label class="text-gray-800 text-sm mb-2 block">URL video</label>
                    <input type="text" name="course_content_video" placeholder="insert the link..."
                      class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                  </div>
                  <div>
                    <select name="course_category" id="ajoutBtn_course"
                      class="block w-full mt-2 px-4 py-2 bg-white border border-gray-900 rounded-md shadow-sm focus:ring-0 focus:outline-none focus:border-gray-300">
                      <option value="" disabled selected class="text-gray-900">Category</option>

                      <?php foreach ($all_category as $category) { ?>
                        <option value="<?= $category["category_name"]; ?>" class="text-gray-900"><?= $category["category_name"]; ?> </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div>
                    <label class="text-gray-800 text-sm mb-2 block">Tags</label>
                    <select 
                      name="tags[]"
                      class="form-select px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg"
                      multiple
                      aria-label="Select multiple tags">
                      <?php foreach ($all_tags as $tag) { ?>
                        <option value="<?= htmlspecialchars($tag['id_tag']); ?>" class="text-gray-900">
                          <?= htmlspecialchars($tag['tag_name']); ?>
                        </option>
                      <?php } ?>
                    </select>

                  </div>




                  <!-- Buttons -->
                  <div class="flex justify-end gap-4 !mt-8">
                    <button type="button" id="ajouteCancelQuiz"
                      class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" id="ajoutQuizBtn" name="add_courses_video"
                      class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
                  </div>
                </form>

              <?php } else { ?>
                <div class="relative flex items-center">
                  <div id="close3" class="absolute top-0 right-0">
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

                  <h1>
                    You need admin validation
                  </h1>
                </div>

              <?php } ?>


            </div>
          </div>


          <!----------------------------------------------- END ADD courses VIDEO ----------------------------------------------------------->

          <!----------------------------------------------- ADD courses DOCUMENT ----------------------------------------------------------->
          <div id="add_courses_document" class="fixed inset-0 p-4 hidden flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
            <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
              <?php if ($isValide) { ?>
                <div class="flex items-center">
                  <h3 class="text-blue-600 text-3xl font-bold flex-1 text-center w-full">ADD COURES</h3>

                  <div id="close4">
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

                <form class="space-y-4 mt-8" action="" method="post" autocomplete="off">
                  <div>
                    <label class="text-gray-800 text-sm mb-2 block">Titre</label>
                    <input type="text" name="course_title" placeholder="write tag here..."
                      class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                  </div>

                  <div>
                    <label class="text-gray-800 text-sm mb-2 block">Description</label>
                    <input type="text" name="course_description" placeholder="write tag here..."
                      class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                  </div>
                  <div>
                    <label for="">document text</label>
                    <textarea name="course_content_document" id=""></textarea>
                  </div>
                  <div>
                    <select name="course_category" id="ajoutBtn_course"
                      class="block w-full mt-2 px-4 py-2 bg-white border border-gray-900 rounded-md shadow-sm focus:ring-0 focus:outline-none focus:border-gray-300">
                      <option value="" disabled selected class="text-gray-900">Category</option>

                      <?php foreach ($all_category as $category) { ?>
                        <option value="<?= $category["category_name"]; ?>" class="text-gray-900"><?= $category["category_name"]; ?> </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div>
                    <label class="text-gray-800 text-sm mb-2 block">Tags</label>
                    <select 
                      name="tags[]"
                      class="form-select px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg"
                      multiple
                      aria-label="Select multiple tags">
                      <?php foreach ($all_tags as $tag) { ?>
                        <option value="<?= htmlspecialchars($tag['id_tag']); ?>" class="text-gray-900">
                          <?= htmlspecialchars($tag['tag_name']); ?>
                        </option>
                      <?php } ?>
                    </select>

                  </div>

                  <!-- Buttons -->
                  <div class="flex justify-end gap-4 !mt-8">
                    <button type="button" id="ajouteCancelQuiz"
                      class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" id="ajoutQuizBtn" name="add_courses_document"
                      class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
                  </div>
                </form>

              <?php } else { ?>
                <div class="relative flex items-center">
                  <div id="close3" class="absolute top-0 right-0">
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

                  <h1>
                    You need admin validation
                  </h1>
                </div>

              <?php } ?>


            </div>
          </div>


          <!----------------------------------------------- END ADD courses DOCUMENT ----------------------------------------------------------->



        </section>

      </div>
    </div>

  <?php } else { ?>
    <?php include "404_page.php" ?>

  <?php } ?>




</body>
<script>
  let courseBtn = document.getElementById("courseBtn");
  let course = document.getElementById("course");

  courseBtn.addEventListener("click", () => {

    course.style.display = "flex";
    // dashboard.style.display = "none";
    // teacher.style.display = "none";


  });


  // ---------------add course------------
  let add_courses_video = document.getElementById("add_courses_video");
  let add_courses_document = document.getElementById("add_courses_document");
  let ajoutBtn_course = document.getElementById("ajoutBtn_course");
  let close4 = document.getElementById("close4");

  ajoutBtn_course.addEventListener("change", (e) => {
    const selectedPage = e.target.value;
    add_courses_video.classList.add("hidden");
    add_courses_video.classList.remove("flex");
    add_courses_document.classList.add("hidden");
    add_courses_document.classList.remove("flex");

    if (selectedPage === 'video') {

      add_courses_video.classList.remove("hidden");
      add_courses_video.classList.add("flex");

    } else if (selectedPage === 'document') {

      add_courses_document.classList.remove("hidden");
      add_courses_document.classList.add("flex");

    }


  });

  close3.addEventListener("click", () => {

    add_courses_video.classList.remove("flex");
    add_courses_video.classList.add("hidden");

  });
  close4.addEventListener("click", () => {

    add_courses_document.classList.remove("flex");
    add_courses_document.classList.add("hidden");

  });
</script>






</html>