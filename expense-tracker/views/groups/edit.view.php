<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form class="max-w-sm mx-auto" method="POST" action="/groups">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $groups['id'] ?>">
            <div class="mb-5">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group
                    Name</label>
                <input type="text" id="text" name="name" value=<?= $groups['name'] ?>
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />

                <?php if (isset($errors['name'])): ?>
                    <p class="text-red-500 text-xs"><?= $errors['name'] ?></p>
                <?php endif; ?>
            </div>

            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 flex gap-x-4 justify-end items-center">
                <button type="button" class="text-red-500 mr-auto"
                    onclick="document.querySelector('#delete-form').submit()">Delete</button>
                <a href="/groups"
                    class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update
                </button>
            </div>


        </form>
        <form id="delete-form" class="hidden" method="POST" action="/groups">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $groups['id'] ?>">
        </form>

    </div>
</main>
<?php require BASE_PATH . "views/partials/footer.php"; ?>   