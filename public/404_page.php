<?php 
$role = $_SESSION["role"] ?? "";

?>

<section class="flex items-center h-screen p-16 bg-gray-50 dark:bg-gray-700">
    <div class="container flex flex-col items-center ">
        <div class="flex flex-col gap-6 max-w-md text-center">
            <h2 class="font-extrabold text-9xl text-gray-600 dark:text-gray-100">
                <span class="sr-only">Error</span>403
            </h2>
            <p class="text-2xl md:text-3xl dark:text-gray-300">Sorry,this page is forbidden .</p>
            <a 
            <?php if($role == "admin"){?>
                href="admin.php"

                <?php } else if($role == "teacher"){?>
    
                href="teacher.php"

                <?php } else if($role == "student"){?>
                    href="teacher.php"
                <?php } else{?>
                    href="index.php"
                <?php }?>
            
            class="px-8 py-4 text-xl font-semibold rounded bg-purple-600 text-gray-50 hover:text-gray-200">GO BACK TO YOUR PAGE</a>
        </div>
    </div>
</section>