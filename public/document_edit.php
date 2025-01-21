<!----------------------------------------------- EDIT  DOCUMENT CONTENT ----------------------------------------------------------->


<div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
        <div class="flex items-center">
            <h3 class="text-blue-600 text-3xl font-bold flex-1 text-center w-full">EDIT COURSE</h3>
        </div>

        <form class="space-y-4 mt-8" action="" method="post" autocomplete="off">
        <?php foreach ($getcourseDetail as $Detail) { ?>
            <input type="hidden" name="id_course" value="<?= htmlspecialchars($Detail['id_course'] ?? '') ?>">


            <div>
                <label class="text-gray-800 text-sm mb-2 block">Titre</label>
                <input type="text" name="course_title"value="<?= htmlspecialchars($Detail['title'] ?? '') ?>"
                    class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
            </div>

            <div>
                <label class="text-gray-800 text-sm mb-2 block">Description</label>
                <input type="text" name="course_description" placeholder="write tag here..." value="<?= htmlspecialchars($Detail['description'] ?? '') ?>"
                    class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
            </div>
            <div >
                <label class="text-gray-800 text-sm mb-2 block">document text</label>
                <textarea name="course_content_document" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg"   ><?= htmlspecialchars($Detail['document_text'] ?? '') ?></textarea>
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

            <!-- Buttons -->
            <div class="flex justify-end gap-4 !mt-8">
                <button type="button" id="ajouteCancelQuiz"
                    class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" id="ajoutQuizBtn" name="edit_courses_document"
                    class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
            </div>
            <?php } ?>

        </form>



    </div>
</div>


<!----------------------------------------------- END EDIT TAG ----------------------------------------------------------->