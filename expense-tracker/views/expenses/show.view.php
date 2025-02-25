<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mt-4 space-y-4" id="expenses-list">
            <?php foreach ($expenses as $expense): ?>
                <div class="expense-item bg-white p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-100 hover:scale-103 flex justify-between items-center border border-gray-200"
                    data-expense-id="<?= $expense['id'] ?>">
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
                        <form class="delete-expense-form" method="POST" action="/expenses">
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
    <!-- Success Message -->
    <div id="delete-success-message"
        class="hidden fixed bottom-1 right-4 mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-80 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        Expense deleted successfully!
    </div>
    <!-- Loading Spinner -->
    <div id="loading-spinner" class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-700"></div>
    </div>
</main>
<script>
    $(document).ready(function () {
        // Function to fetch and update expenses
        function fetchExpenses() {
            $.ajax({
                url: '/api/expenses',
                type: 'GET',
                beforeSend: function() {
                    $('#loading-spinner').removeClass('hidden');
                },
                success: function(response) {
                    const expensesList = $('#expenses-list');
                    expensesList.empty();

                    response.forEach(function(expense) {
                        const expenseHtml = `
                            <div class="expense-item bg-white p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-100 hover:scale-103 flex justify-between items-center border border-gray-200"
                                data-expense-id="${expense.id}">
                                <div>
                                    <p class="text-lg font-semibold text-gray-800">${expense.name}</p>
                                    <p class="text-sm text-gray-600">Amount: <span
                                            class="font-medium text-gray-700">₹${expense.amount}</span></p>
                                    <p class="text-sm text-gray-600">Date: <span
                                            class="font-medium">${expense.date}</span></p>
                                    <p class="text-sm text-gray-600">Group: <span
                                            class="font-medium">${expense.category || 'Unknown'}</span></p>
                                </div>

                                <div class="flex space-x-2">
                                    <form method="POST" action="/expenses/edit">
                                        <input type="hidden" name="id" value="${expense.id}">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                            Edit
                                        </button>
                                    </form>
                                    <form class="delete-expense-form" method="POST" action="/expenses">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="${expense.id}">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        `;
                        expensesList.append(expenseHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching expenses:', error);
                },
                complete: function() {
                    $('#loading-spinner').addClass('hidden');
                }
            });
        }

        // Fetch expenses every 30 seconds
        setInterval(fetchExpenses, 30000);

        // Handle delete form submission
        $(document).on('submit', '.delete-expense-form', function (e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to delete this expense?')) {
                return;
            }

            const form = $(this);
            const expenseId = form.find('input[name="id"]').val();
            const expenseItem = $(`.expense-item[data-expense-id="${expenseId}"]`);

            $.ajax({
                url: '/expenses',
                type: 'POST',
                data: form.serialize(),
                success: function (response) {
                    // Remove the expense item from the DOM with animation
                    expenseItem.fadeOut(300, function () {
                        $(this).remove();
                    });

                    // Show success message
                    const successMessage = $('#delete-success-message');
                    successMessage.removeClass('hidden').fadeIn();

                    // Hide success message after 3 seconds
                    setTimeout(function () {
                        successMessage.fadeOut(300, function () {
                            $(this).addClass('hidden');
                        });
                    }, 3000);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the expense: ' + error);
                }
            });
        });
    });
</script>

<?php require base_path("views/partials/footer.php"); ?>