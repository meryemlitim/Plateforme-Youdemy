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

$course1 = new content_video();
$cours = new content_video();

$getcourseDetail = $course1->allCourses();

// -----------Récupération des paramètres

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Toujours s'assurer que la page est au moins 1
$limit = 6; // Nombre de cours par page
$offset = ($page - 1) * $limit; // Calcul de l'offset



// Récupérer les cours filtrés et paginés
$coursList = $cours->getCoursWithPagination($search, $limit, $offset);
// print_r($coursList);

// Compter le nombre total de cours correspondant à la recherche
$totalCours = $cours->countCours($search);
$totalPages = ceil($totalCours / $limit);




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
</head>

<body>
    <?php include "../template/header_user.php" ?>


    <!-- Header Start -->
    <div class="relative bg-cover bg-center h-[600px] w-full" style="background-image: url('https://ici.net.au/blog/wp-content/uploads/2022/01/Study-Tips.jpg'); margin-bottom: 90px;">
        <!-- Dark overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Content -->
        <div class="relative z-10 text-center text-white py-28">
            <!-- Headings -->
            <h1 class="text-5xl sm:text-6xl font-extrabold">Learn From Home</h1>
            <br>
            <h1 class="text-5xl sm:text-6xl font-extrabold">YOUDEMY</h1>

            <!-- Search -->
            <div class="mt-10 max-w-3xl mx-auto">

                <form method="GET" action="">
                    <div class="flex shadow-lg">
                        <input name="search" type="text" class="flex-1 border-t border-b border-gray-300 px-6 py-4 text-black" placeholder="Search courses..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        <button id="scroll" type="submit" class="bg-blue-600 text-white px-6 py-4 rounded-r-md text-lg font-semibold hover:bg-blue-700">Search</button>
                    </div>

                </form>


            </div>
        </div>
    </div>

    <!-- Courses Start -->
    <div class="py-5">
        <div class="container py-5 px-8"> <!-- Increased padding on container -->
            <div class="flex justify-center mb-5">
                <div class="w-full lg:w-2/3">
                    <div class="text-center relative mb-5">
                        <h6 class="inline-block text-secondary uppercase pb-2">Our Courses</h6>
                        <h1 class="text-4xl">Checkout New Releases Of Our Courses</h1>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($coursList as $Detail) { ?>
                    <!-- <form method="post"> -->
                    <div class=" course_detail relative pb-4 w-3/4 mx-auto ">
                        <a class="relative block overflow-hidden mb-2"
                            <?php if ($Detail['type'] == 'video') { ?>
                            href="detail_video.php?id_course=<?= $Detail['id_course'] ?>"
                            <?php } else { ?>
                            href="detail_document.php?id_course=<?= $Detail['id_course'] ?>"

                            <?php } ?>>
                            <img class="w-full h-auto" src="https://cdn.vectorstock.com/i/thumb-large/27/08/avatar-woman-and-learning-online-concept-vector-28092708.jpg" alt=""> <!-- Image width reduced -->
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                                <h4 class="text-center"><?= htmlspecialchars($Detail['title'] ?? '') ?></h4>
                                <div class="border-t mt-3">
                                    <div class="flex justify-between p-4">
                                        <span><i class="fa fa-user mr-2"></i><?= htmlspecialchars($Detail['username'] ?? '') ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- </form> -->
                <?php } ?>


            </div>
            <!-- Pagination -->
            <!-- Pagination -->
            <div class="flex justify-center mt-6 space-x-2">
                <?php if ($page > 1): ?>
                    <a href="?search=<?= urlencode($search); ?>&page=<?= $page - 1; ?>"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Précédent</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?search=<?= urlencode($search); ?>&page=<?= $i; ?>"
                        class="px-4 py-2 <?= $i === $page ? 'bg-blue-500 text-white' : 'bg-gray-300'; ?> rounded-lg hover:bg-gray-400">
                        <?= $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?search=<?= urlencode($search); ?>&page=<?= $page + 1; ?>"
                        class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Suivant</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Courses End -->



    <?php include "../template/footer.php" ?>


    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navbarCollapse = document.getElementById('navbarCollapse');
        menuToggle.addEventListener('click', () => {
            navbarCollapse.classList.toggle('hidden');
        });


        document.querySelectorAll(".course_detail").forEach((counter) => {
            counter.addEventListener('click', function() {
                const form = this.closest("form");
                form.submit();
            });
        });

        document.getElementById('scroll').addEventListener('click', () => {

            const form = this.closest("form");
            if(form.submit()){
                window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            }


        });
    </script>
</body>



</html>