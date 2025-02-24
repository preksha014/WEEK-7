<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form id="add-group-form" class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto">
            <div id="error-message" class="hidden mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg"></div>
            <div class="mb-5">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group
                    Name</label>
                <input type="text" id="text" name="name"
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />
                <p id="error-name" class="text-red-500 text-xs"></p>
                <p id="error-duplicate" class="text-red-500 text-xs"></p>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Add Group
            </button>

            <!-- Success Message -->
            <p id="success-message" class="text-green-500 text-sm mt-2 hidden"></p>
        </form>
</main>

<script>
    $(document).ready(function () {
        $('#add-group-form').validate({
            rules: { text: { required: true } },
            messages: { text: { required: 'Group name is required.' } },
            submitHandler: function (form) {
                $.ajax({
                    url: '/groups',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ name: $('#text').val().trim() }),
                    success: function (response) {
                        if (response.success) {
                            $('#success-message').text('Group added successfully!').removeClass('hidden');
                            form.reset();
                        } else {
                            $('#error-duplicate').text(response.error === 'duplicate' ? 'Group name already exists.' : 'An error occurred.');
                        }
                    }
                });
            }
        });
    });

</script>
<?php require BASE_PATH . "views/partials/footer.php"; ?>