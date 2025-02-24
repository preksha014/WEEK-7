<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto" method="POST" action="/expenses">
            <!-- Hidden Fields for PATCH Request -->
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= htmlspecialchars($expense['id']) ?>">

            <!-- Expense Name -->
            <div class="mb-4">
                <label for="expense-name" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Expense Name
                </label>
                <input type="text" id="expense-name" name="name" value="<?= htmlspecialchars($expense['name']) ?>"
                    class="w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg shadow-sm 
                   focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <?php if (isset($errors['name'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errors['name']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Amount
                </label>
                <input type="number" id="amount" name="amount" value="<?= htmlspecialchars($expense['amount']) ?>"
                    class="w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg shadow-sm 
                   focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>

            <!-- Date of Expense -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Date of Expense
                </label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($expense['date']) ?>" class="w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg shadow-sm 
                   focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            </div>
            <!-- Group Dropdown -->
            <div class="mb-6">
                <label for="group" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Group
                </label>
                <select name="group_id" id="group" class="w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg shadow-sm 
                   focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select a Group</option>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group['id'] ?>" <?= (isset($expense['group_id']) && $expense['group_id'] == $group['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($group['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end items-center gap-x-4">
                <a href="/expenses" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-500 
                   rounded-lg shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 
                   focus:ring-gray-400 focus:ring-offset-2">
                    Cancel
                </a>

                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 
                   rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 
                   focus:ring-indigo-500 focus:ring-offset-2">
                    Update
                </button>
            </div>
        </form>

    </div>
    <script>
        document.getElementById("edit-expense-form").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch(BASE_PATH + "expenses/update.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "/expenses"; // Redirect after success
                    } else {
                        document.getElementById("error-message").textContent = data.error;
                        document.getElementById("error-message").classList.remove("hidden");
                    }
                })
                .catch(error => console.error("Error:", error));
        });
    </script>
</main>
<?php require base_path("views/partials/footer.php"); ?>