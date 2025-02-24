<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form id="add-group-form" class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto" method="POST" action="/groups">
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
    $("#add-group-form").submit(function (e) {
        e.preventDefault(); // Prevent default form submission

        let formData = $(this).serialize();
        let name = $("#text").val().trim();

        // Clear previous errors
        $("#error-name").text("");
        $("#error-duplicate").text("");

        // Client-side validation
        if (name.length === 0) {
            $("#error-name").text("Group name is required");
            return;
        }

        $.ajax({
            url: "/groups", // Adjust if needed
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "error") {
                    if (response.errors.name) {
                        $("#error-name").text(response.errors.name);
                    }
                    if (response.errors.duplicate) {
                        $("#error-duplicate").text(response.errors.duplicate);
                    }
                } else {
                    $("#success-message").removeClass("hidden").text(response.message);
                    setTimeout(function () {
                        window.location.href = "/groups";
                    }, 2000); // Redirect after displaying success message
                }
            },
            error: function () {
                alert("An error occurred. Please try again.");
            }
        });
    });
});

</script>

<?php require BASE_PATH . "views/partials/footer.php"; ?>