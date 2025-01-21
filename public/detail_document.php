<div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-8 relative h-auto">
    <?php foreach ($getcourseDetail as $Detail) { ?>

        <h1 class="text-3xl font-bold text-blue-600 mb-4"><?= htmlspecialchars($Detail['title'] ?? '') ?></h1>
        <p class="text-gray-700 mb-2"><strong>Description:</strong><?= htmlspecialchars($Detail['description'] ?? '') ?></p>
        <p class="text-gray-700 mb-2"><strong>Created by:</strong> <?= htmlspecialchars($Detail['username'] ?? '') ?></p>
        <p class="text-gray-700 mb-2"><strong>Category:</strong><?= $Detail["category_name"]; ?></p>
        <p class="text-gray-700 mb-2"><strong>Date of Creation:</strong> <?= $Detail["date_creation"]; ?></p>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Document Content</h2>
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md">
                <p><?= $Detail["document_text"]; ?></p>
            </div>
        </div>
        <?php } ?>

    </div>


</div>