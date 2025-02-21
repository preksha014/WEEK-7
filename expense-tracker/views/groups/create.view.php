<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto" method="POST" action="/groups">
            <div class="mb-5">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group
                    Name</label>
                <input type="text" id="text" name="name"
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />
                <?php if (isset($errors['name'])): ?>
                    <p class="text-red-500 text-xs"><?= $errors['name'] ?></p>
                <?php endif; ?>
                <?php if (isset($errors['duplicate'])): ?>
                    <p class="text-red-500 text-xs"><?= $errors['duplicate'] ?></p>
                <?php endif; ?>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                Group</button>

        </form>

    </div>
</main>
<?php require BASE_PATH . "views/partials/footer.php"; ?>