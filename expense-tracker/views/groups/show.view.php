<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8" id="groups-container">
        <div id="loading-indicator" class="hidden text-center py-4">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
        </div>
        <div id="groups-list">
            <?php foreach ($groups as $group): ?>
                <div class="group-item bg-white p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-100 hover:scale-103 border border-gray-200 mt-4 flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-200 hover:scale-103"
                    data-group-id="<?= $group['id'] ?>">
                    <span class="font-semibold text-gray-800">
                        <?= getGroupEmoji($group['name']) ?>     <?= $group['name'] ?>
                    </span>
                    <div class="flex space-x-2">
                        <form method="POST" action="/groups/edit">
                            <input type="hidden" name="id" value="<?= $group['id'] ?>">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Edit
                            </button>
                        </form>
                        <form class="delete-group-form" method="POST" action="/groups">
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
        </div>
        <div class="mt-4">
            <a href="/groups/create">
                <button
                    class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Group
                </button>
            </a>
        </div>
    </div>
    <!-- Success Message -->
    <div id="delete-success-message"
        class="hidden fixed bottom-1 right-4 mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-80 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        Group deleted successfully!
    </div>
</main>
<script>
    $(document).ready(function () {
        function fetchGroups() {
            $('#loading-indicator').removeClass('hidden');
            
            $.ajax({
                url: '/groups/fetch',
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        updateGroupsList(response.groups);
                    } else {
                        console.error('Failed to fetch groups:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching groups:', error);
                },
                complete: function() {
                    $('#loading-indicator').addClass('hidden');
                }
            });
        }

        function updateGroupsList(groups) {
            const groupsList = $('#groups-list');
            let newHtml = '';
            
            groups.forEach(function(group) {
                newHtml += `
                    <div class="group-item bg-white p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-100 hover:scale-103 border border-gray-200 mt-4 flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow transition duration-200 ease-in-out transform hover:shadow-lg hover:bg-gray-200 hover:scale-103"
                        data-group-id="${group.id}">
                        <span class="font-semibold text-gray-800">
                            ${group.emoji}     ${group.name}
                        </span>
                        <div class="flex space-x-2">
                            <form method="POST" action="/groups/edit">
                                <input type="hidden" name="id" value="${group.id}">
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Edit
                                </button>
                            </form>
                            <form class="delete-group-form" method="POST" action="/groups">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="${group.id}">
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                `;
            });
            
            groupsList.html(newHtml);
        }

        // Fetch groups every 10 seconds
        setInterval(fetchGroups, 10000);

        // Handle delete form submission
        $(document).on('submit', '.delete-group-form', function (e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to delete this group?')) {
                return;
            }

            const form = $(this);
            const groupId = form.find('input[name="id"]').val();
            const groupItem = $(`.group-item[data-group-id="${groupId}"]`);

            $.ajax({
                url: '/groups',
                type: 'POST',
                data: form.serialize(),
                success: function (response) {
                    // Remove the group item from the DOM with animation
                    groupItem.fadeOut(300, function () {
                        $(this).remove();
                    });

                    // Show success message
                    const successMessage = $('#delete-success-message');
                    successMessage.removeClass('hidden').fadeIn();

                    // Hide success message after 3 seconds
                    setTimeout(function () {
                        successMessage.fadeOut(300, function () {
                            $(this).addClass('hidden');
                        });
                    }, 3000);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the group: ' + error);
                }
            });
        });
    });
</script>

<?php require BASE_PATH . "views/partials/footer.php"; ?>