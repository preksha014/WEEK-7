<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form class="max-w-sm mx-auto mb-5" method="POST" action="/expenses">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expense
                Name</label>
            <input type="text" id="text" name="name"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />
            <?php if (isset($errors['name'])): ?>
                <p class="text-red-500 text-xs"><?= $errors['name'] ?></p>
            <?php endif; ?>

            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount
            </label>
            <input type="number" id="amount" name="amount"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />

            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Expense
            </label>
            <input type="date" id="date" name="date"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />

            <label for="group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group
            </label>
            <select name="group"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light">
                <option>Select Group</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit"
                class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                Expense</button>
        </form>
    </div>
</main>
<?php require base_path("views/partials/footer.php"); ?>