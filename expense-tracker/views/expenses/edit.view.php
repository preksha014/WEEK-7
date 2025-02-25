<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form id="editExpenseForm" class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto" method="POST"
            action="/expenses">
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
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                <p class="text-red-500 text-xs mt-1 error-message" id="name-error"></p>
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Amount
                </label>
                <input type="number" id="amount" name="amount" value="<?= htmlspecialchars($expense['amount']) ?>"
                    class="w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg shadow-sm 
                   focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                <p class="text-red-500 text-xs mt-1 error-message" id="amount-error"></p>
            </div>

            <!-- Date of Expense -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Date of Expense
                </label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($expense['date']) ?>" class="w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg shadow-sm 
                   focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                <p class="text-red-500 text-xs mt-1 error-message" id="date-error"></p>
            </div>

            <!-- Group Dropdown -->
            <div class="mb-6">
                <label for="group" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Group
                </label>
                <select name="group_id" id="group" class="w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg shadow-sm 
                   focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 
                   dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Select a Group</option>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group['id'] ?>" <?= (isset($expense['group_id']) && $expense['group_id'] == $group['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($group['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="text-red-500 text-xs mt-1 error-message" id="group-error"></p>
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
    <!-- Success Message -->
    <div id="success-message"
        class="hidden fixed bottom-1 right-4 mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        Expense updated successfully!
    </div>
</main>

<script>
    $(document).ready(function () {
        $('#editExpenseForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                amount: {
                    required: true,
                    number: true,
                    min: 0
                },
                date: {
                    required: true,
                    date: true
                },
                group_id: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter an expense name",
                    minlength: "Expense name must be at least 2 characters long"
                },
                amount: {
                    required: "Please enter an amount",
                    number: "Please enter a valid number",
                    min: "Amount must be greater than or equal to 0"
                },
                date: {
                    required: "Please select a date",
                    date: "Please enter a valid date"
                },
                group_id: {
                    required: "Please select a group"
                }
            },
            errorElement: 'p',
            errorClass: 'text-red-500 text-xs mt-1',
            // errorPlacement: function(error, element) {
            //     error.addClass('text-red-500 text-xs mt-1');
            //     error.insertAfter(element);
            // },
            submitHandler: function (form) {
                $.ajax({
                    url: '/expenses',
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function (response) {
                        $('#success-message').removeClass('hidden');
                        setTimeout(function () {
                            window.location.href = '/expenses';
                        }, 1000);
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            //console.log(xhr.responseText);
                            const errors = JSON.parse(xhr.responseText);
                            Object.keys(errors).forEach(field => {
                                $(`#${field}-error`).text(errors[field]);
                            });
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
                return false;
            }
        });
    });
</script>

<?php require base_path("views/partials/footer.php"); ?>