<!----------------------------------------------- EDIT TAG ----------------------------------------------------------->
<?php
echo '<pre>';
var_dump($update_tag);
echo '</pre>';
?>
<div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
            <div class="flex items-center">
                <h3 class="text-blue-600 text-3xl font-bold flex-1 text-center w-full">EDIT TAGS</h3>

                

            </div>

            <form class="space-y-4 mt-8" action="" method="post" autocomplete="off">

                <div>
                    <!-- <label class="text-gray-800 text-sm mb-2 block">Titre</label> -->
                    <input type="text" name="newTag_name" placeholder="<?php echo $update_tag["tag_name"]?>"
                        class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>
                <div class="flex justify-end gap-4 !mt-8">
                    <button type="button" id="ajouteCancelQuiz"
                        class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <input type="text" value="<?php echo $update_tag["id_tag"]?>">
                    <button type="submit" name="update_tag" value="<?php echo $update_tag["id_tag"]?>"
                        class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
                </div>


            </form>
        </div>
    </div>


    <!----------------------------------------------- END EDIT TAG ----------------------------------------------------------->