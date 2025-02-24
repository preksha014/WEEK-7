<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto" method="POST" action="/expenses">
            <!-- Expense Name -->
            <div class="mb-4">
                <label for="expense-name" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Expense Name
                </label>
                <input type="text" id="expense-name" name="name" class="w-full p-2.5 border border-gray-300 rounded-lg shadow-sm 
                   text-gray-900 focus:ring-blue-500 focus:border-blue-500 
                   dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                   dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                <?php if (isset($errors['name'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errors['name']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Amount
                </label>
                <input type="number" id="amount" name="amount" class="w-full p-2.5 border border-gray-300 rounded-lg shadow-sm 
                   text-gray-900 focus:ring-blue-500 focus:border-blue-500 
                   dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                   dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                <?php if (isset($errors['amount'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errors['amount']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Date of Expense -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Date of Expense
                </label>
                <input type="date" id="date" name="date" class="w-full p-2.5 border border-gray-300 rounded-lg shadow-sm 
                   text-gray-900 focus:ring-blue-500 focus:border-blue-500 
                   dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                   dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
                <?php if (isset($errors['date'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errors['date']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Group Dropdown -->
            <div class="mb-6">
                <label for="group" class="block text-sm font-medium text-gray-900 dark:text-white mb-1">
                    Group
                </label>
                <select name="group_id" id="group" class="w-full p-2.5 border border-gray-300 rounded-lg shadow-sm 
                   text-gray-900 focus:ring-blue-500 focus:border-blue-500 
                   dark:bg-gray-700 dark:border-gray-600 dark:text-white 
                   dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    <option value="">Select a Group</option>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['name']) ?></option>
                    <?php endforeach; ?>
                    
                </select>
                <?php if (isset($errors['group_id'])): ?>
                      <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errors['group_id']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-5 py-2.5 text-white bg-blue-700 hover:bg-blue-800 
               focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium 
               rounded-lg text-sm text-center dark:bg-blue-600 
               dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add Expense
            </button>
        </form>

    </div>
    <script>
        $(document).ready(function () {
            $("#add-expense-form").submit(function (event) {
                event.preventDefault(); // Prevent default form submission

                let expenseName = $("#expense-name").val();
                let amount = $("#amount").val();
                let date = $("#date").val();
                let groupId = $("#group").val();
                let formData = { name: expenseName, amount: amount, date: date, group_id: groupId };

                $.ajax({
                    url: "/expenses", // API for handling expense creation
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            $("#success-message").text(response.message).removeClass("hidden"); // Show success message
                            $("#error-name, #error-amount, #error-date, #error-group").text(""); // Clear errors
                            $("#expense-name, #amount, #date, #group").val(""); // Clear input fields

                            setTimeout(() => {
                                window.location.href = "/expenses"; // Redirect after 1.5 sec
                            }, 1500);
                        } else {
                            // Show validation errors
                            $("#error-name").text(response.errors.name ? response.errors.name : "");
                            $("#error-amount").text(response.errors.amount ? response.errors.amount : "");
                            $("#error-date").text(response.errors.date ? response.errors.date : "");
                            $("#error-group").text(response.errors.group_id ? response.errors.group_id : "");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script>
</main>
<?php require base_path("views/partials/footer.php"); ?>