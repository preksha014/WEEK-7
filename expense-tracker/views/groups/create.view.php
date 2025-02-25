<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form id="createGroupForm" class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto" method="POST"
            action="/groups">
            <div class="mb-5">
                <label for="group-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Group
                    Name</label>
                <input type="text" id="group-name" name="name"
                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" />
                <p class="text-red-500 text-xs mt-1" id="name-error"></p>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                Group</button>
        </form>
    </div>
    <!-- Success Message -->
    <div id="success-message"
        class="hidden fixed bottom-4 right-4 mb-4 p-4 text-sm font-semibold text-green-900 bg-green-100 border border-green-400 rounded-lg shadow-lg dark:bg-gray-800 dark:text-green-300 dark:border-green-600 z-50 flex items-center space-x-2"
        role="alert">
        <span>Group created successfully!</span>
    </div>
</main>

<script>
    $(document).ready(function () {
        // Initialize form validation
        $("#createGroupForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                name: {
                    required: "Please enter a group name",
                    minlength: "Group name must be at least 2 characters long"
                }
            },
            errorElement: 'p',
            errorClass: 'text-red-500 text-xs mt-1',
            submitHandler: function (form) {
                $.ajax({
                    url: '/groups',
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function (response) {
                        // Show success message
                        $('#success-message').removeClass('hidden');

                        // Reset form
                        form.reset();

                        // Redirect after 1 second
                        setTimeout(function () {
                            window.location.href = '/groups';
                        }, 1000);
                    },
                    error: function (xhr) {
                        // Handle errors if needed
                        console.error('Error:', xhr.responseText);
                    }
                });
                return false;
            }
        });
    });
</script>

<?php require BASE_PATH . "views/partials/footer.php"; ?>