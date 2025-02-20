<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>
<?php require base_path("views/partials/banner.php"); ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form class="max-w-sm mx-auto mb-5" method="POST" action="/expenses">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $expense['id'] ?>">

            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expense
                Name</label>
            <input type="text" id="text" name="name" value="<?= $expense['name'] ?>"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />
            <?php if (isset($errors['name'])): ?>
                <p class="text-red-500 text-xs"><?= $errors['name'] ?></p>
            <?php endif; ?>

            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount
            </label>
            <input type="number" id="number" name="amount" value="<?= $expense['amount'] ?>"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />

            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Expense
            </label>
            <input type="date" id="date" name="date" value="<?= $expense['date'] ?>"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />

            <label for="group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group
            </label>
            <select name="group_id"
                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light">
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['id'] ?>" <?= (isset($expense['group_id']) && $expense['group_id'] == $group['id']) ? 'selected' : '' ?>>
                        <?= $group['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 flex gap-x-4 justify-end items-center">
                <button type="button" class="text-red-500 mr-auto"
                    onclick="document.querySelector('#delete-form').submit()">Delete</button>

                <a href="/expenses"
                    class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update
                </button>
            </div>
        </form>

        <!-- Delete Expense from database -->
        <form id="delete-form" class="hidden" method="POST" action="/expenses">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $expense['id'] ?>">
        </form>
    </div>
</main>
<?php require base_path("views/partials/footer.php"); ?>