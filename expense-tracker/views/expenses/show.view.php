<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mt-4 space-y-4">
            <?php foreach ($expenses as $expense): ?>
                <div
                    class="bg-white p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-100 hover:scale-103 flex justify-between items-center border border-gray-200">
                    <div>
                        <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($expense['name']) ?></p>
                        <p class="text-sm text-gray-600">Amount: <span
                                class="font-medium text-gray-700">₹<?= htmlspecialchars($expense['amount']) ?></span></p>
                        <p class="text-sm text-gray-600">Date: <span
                                class="font-medium"><?= htmlspecialchars($expense['date']) ?></span></p>
                        <p class="text-sm text-gray-600">Group: <span
                                class="font-medium"><?= htmlspecialchars($expense['category'] ?? 'Unknown') ?></span></p>
                    </div>

                    <div class="flex space-x-2">
                        <form method="POST" action="/expenses/edit">
                            <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Edit
                            </button>
                        </form>
                        <form method="POST" action="/expenses">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4">
            <a href="/expenses/create">
                <button
                    class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Expense
                </button>
            </a>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            function fetchExpenses() {
                $.ajax({
                    url: "/expenses", // Correct API endpoint
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        let expenseHtml = ""; // Initialize empty string
                        if (response.length > 0) { // Check if response is not empty
                            response.forEach(expense => {
                                expenseHtml += `
                                                <div class="bg-white p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-100 hover:scale-103 flex justify-between items-center border border-gray-200">
                                                    <div>
                                                        <p class="text-lg font-semibold text-gray-800">${expense.name}</p>
                                                        <p class="text-sm text-gray-600">Amount: <span class="font-medium text-gray-700">₹${expense.amount}</span></p>
                                                        <p class="text-sm text-gray-600">Date: <span class="font-medium">${expense.date}</span></p>
                                                        <p class="text-sm text-gray-600">Group: <span class="font-medium">${expense.category ?? 'Unknown'}</span></p>
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <form method="POST" action="/expenses/edit">
                                                            <input type="hidden" name="id" value="${expense.id}">
                                                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                                Edit
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="/expenses">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="id" value="${expense.id}">
                                                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                                Delete
                                                            </button>
                                                        </form>`});
                        } else {
                            expenseHtml = `<p class="text-gray-600">No expenses available.</p>`;
                        }
                        $("#group-list").html(expenseHtml); // Inject into div
                    }
                });
            }
            fetchExpenses();
        });
    </script>
</main>
<?php require base_path("views/partials/footer.php"); ?>