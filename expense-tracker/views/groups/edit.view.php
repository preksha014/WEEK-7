<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form id="edit-group-form" class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto" method="POST" action="/groups">
            <!-- Hidden Fields for PATCH Request -->
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= htmlspecialchars($groups['id']) ?>">

            <!-- Group Name Input Field -->
            <div class="mb-5">
                <label for="group-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Group Name
                </label>
                <input type="text" id="group-name" name="name" value="<?= htmlspecialchars($groups['name']) ?>" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                   dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" required />

                <!-- Error Message for Group Name -->
                <?php if (isset($errors['name'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errors['name']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end items-center gap-x-4">
                <a href="/groups" class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 
                   py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 
                   focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 
                   py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update
                </button>
            </div>
        </form>
    </div>
    
<script>
document.getElementById("edit-group-form").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let formData = new FormData(this);
    
    fetch (BASE_PATH.("controllers/groups/update.php"), {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "/groups"; // Redirect after success
        } else {
            document.getElementById("error-message").textContent = data.error;
            document.getElementById("error-message").classList.remove("hidden");
        }
    })
    .catch(error => console.error("Error:", error));
});
</script>
</main>
<?php require BASE_PATH . "views/partials/footer.php"; ?>