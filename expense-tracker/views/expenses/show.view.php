<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mt-4 space-y-4">
            <?php foreach ($expenses as $expense): ?>
                <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center border border-gray-200">
                    <div>
                        <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($expense['name']) ?></p>
                        <p class="text-sm text-gray-600">Amount: <span
                                class="font-medium text-gray-700">₹<?= htmlspecialchars($expense['amount']) ?></span></p>
                        <p class="text-sm text-gray-600">Date: <span
                                class="font-medium"><?= htmlspecialchars($expense['date']) ?></span></p>
                        <p class="text-sm text-gray-600">Group: <span
                                class="font-medium"><?= htmlspecialchars($expense['category'] ?? 'Unknown') ?></span></p>
                    </div>
                    <a href="/expenses/edit?id=<?= $expense['id'] ?>"
                        class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Edit
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4">
            <a href="/expenses/create">
                <button class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Expense
                </button>
            </a>
        </div>
    </div>

</main>
<?php require base_path("views/partials/footer.php"); ?>