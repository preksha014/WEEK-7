<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        <?php foreach ($groups as $group): ?>
            <div class="mt-4 flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow">
                <span class="font-semibold text-gray-800"><?= $group['name'] ?></span>
                <div class="flex space-x-2">
                    <form method="POST" action="/groups/edit">
                        <input type="hidden" name="id" value="<?= $group['id'] ?>">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Edit
                        </button>
                    </form>
                    <form method="POST" action="/groups">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $group['id'] ?>">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

        <?php endforeach; ?>
        <div class="mt-4">
            <a href="/groups/create">
                <button class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Group
                </button>
            </a>
        </div>

    </div>

</main>
<?php require BASE_PATH . "views/partials/footer.php"; ?>