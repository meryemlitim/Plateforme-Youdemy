<?php
require_once "../config/database.php";
require_once "../classes/User.php";
require_once "../classes/Teacher.php";
require_once "../classes/Student.php";


$user = new users();
$teacher = new teachers();
$student = new students();

$user_id = $_SESSION["user_id"] ?? "";
$role = $_SESSION["role"] ?? "";

$all_student = $student->dispaly_student();
$all_teacher = $teacher->dispaly_teacher();


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
    <div class="relative bg-[#f7f6f9] h-full min-h-screen font-[sans-serif]">
        <div class="flex items-start">




            <?php include "../template/sidebare.php" ?>
            <section class="main-content w-full px-8">

                <?php include "../template/header_admin.php" ?>

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
                                                    <img src='https://readymadeui.com/profile_4.webp' class="w-9 h-9 rounded-full shrink-0" />
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
                                                    <img src='https://readymadeui.com/profile_4.webp' class="w-9 h-9 rounded-full shrink-0" />
                                                    <div class="ml-4">
                                                        <p class="text-sm text-black"> <?= $teacher["username"]; ?> </p>
                                                        <p class="text-xs text-gray-500 mt-0.5"><?= $teacher["email"]; ?></p>
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

                        <p>taaags</p>
                    </div>
                </section>
            </section>

        </div>
    </div>

    <!----------------------------------------------- END TEACHER MANAGEMENT ----------------------------------------------------------->
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
                    <button type="submit" id="ajoutQuizBtn" name="submit"
                        class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
                </div>


            </form>
        </div>
    </div>


    <!----------------------------------------------- END ADD TAG ----------------------------------------------------------->


    </section>

    </div>
    </div>


    <script>
        let dashboardBtn = document.getElementById("dashboardBtn");
        let dashboard = document.getElementById("dashboard");
        let user = document.getElementById("user");
        // let teacher = document.getElementById("teacher");
        let userBtn = document.getElementById("userBtn");
        let tagBtn = document.getElementById("tagBtn");
        let teacher = document.getElementById("teacher");
        let tag = document.getElementById("tag");
        let GameBtn = document.getElementById("GameBtn");


        // dashboardBtn.addEventListener("click", () => {

        //     dashboard.style.display = "flex";
        //     user.style.display = "none";
        //     teacher.style.display = "none";

        // });


        userBtn.addEventListener("click", () => {

            user.style.display = "flex";
            // dashboard.style.display = "none";
            teacher.style.display = "none";
            tag.style.display = "none";

        });

        GameBtn.addEventListener("click", () => {

            teacher.style.display = "flex";
            // dashboard.style.display = "none";
            user.style.display = "none";
            tag.style.display = "none";

        });

        tagBtn.addEventListener("click", () => {
            tag.style.display = "flex";
            // dashboard.style.display = "none";
            user.style.display = "none";
            teacher.style.display = "none";

        });

        // userBtn.addEventListener("click", () => {

        //   user.style.display = "flex";
        //   dashboard.style.display = "none";
        //   Game.style.display = "none";

        // });

        let artcile = document.querySelector(".artcile");

        let add_tag = document.getElementById("add_tag");
        let ajoutBtn = document.getElementById("ajoutBtn");
        let clsoe1 = document.getElementById("close1");

        ajoutBtn.addEventListener("click", () => {

            add_tag.classList.remove("hidden");
            add_tag.classList.add("flex");

        });


        close1.addEventListener("click", () => {

            add_tag.classList.remove("flex");
            add_tag.classList.add("hidden");

        });
    </script>
</body>

</html>