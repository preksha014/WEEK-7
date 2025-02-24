<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <div id="group-list">
        <?php foreach ($groups as $group): ?>
            <div class="mt-4 flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-200 hover:scale-103">
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
                            class="delete-group inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
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
</div>
<script>
$(document).ready(function () {
    function fetchGroups() {
        $.ajax({
            url: "/groups", // Correct API endpoint
            type: "GET",
            dataType: "json",
            success: function (response) {
                let groupHtml = ""; // Initialize empty string:groupHtml=""
                if (response.length > 0) { // Check if response is not empty
                    response.forEach(group => {
                        groupHtml += `
                            <div class="bg-white p-4 rounded-lg shadow-md mb-2">
                                <p class="text-lg font-semibold">${group.name}</p>
                            </div>
                        `; //append each group to groupHtml
                    });
                } else {
                    groupHtml = `<p class="text-gray-600">No groups available.</p>`;
                }
                $("#group-list").html(groupHtml); // Inject into div
            },
            error: function (xhr, status, error) {
                console.error("Error fetching groups:", error);
            }
        });
    }
    // Function to delete a group
    function deleteGroup(groupId) {
        if (!confirm("Are you sure you want to delete this group?")) {
            return;
        }

        $.ajax({
            url: "/groups", // Delete API endpoint
            type: "POST",
            data: { id: groupId },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("Group deleted successfully!");
                    fetchGroups(); // Refresh group list after deletion
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function () {
                alert("Failed to delete group. Try again.");
            }
        });
    }

    // Bind delete event dynamically
    function bindDeleteEvent() {
        $(".delete-group").click(function () {
            let groupId = $(this).data("id");
            deleteGroup(groupId);
        });
    }
    fetchGroups(); // Fetch when the page loads
});
</script>

</main>
<?php require BASE_PATH . "views/partials/footer.php"; ?>