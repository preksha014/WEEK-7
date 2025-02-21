<?php require BASE_PATH . "views/partials/head.php"; ?>
<?php require BASE_PATH . "views/partials/nav.php"; ?>
<?php require BASE_PATH . "views/partials/banner.php"; ?>

<main>
        <div class="container mx-auto p-8">
            <!-- Total, Monthly, and Max Expense -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold">Total Expense</h2>
                    <p class="text-xl">₹<?= $totalExpense['total_expense'] ?? 0; ?></p>
                </div>
                <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold">Maximum Expense</h2>
                    <p class="text-xl">₹<?= $maxExpense['amount'] ?? 0; ?></p>
                    <p class="text-sm"><?= $maxExpense['name'] ?? 'N/A'; ?></p>
                </div>
                <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold">Monthly Expense</h2>
                    <?php foreach ($monthlyExpense as $month) : ?>
                        <p><?= $month['month']; ?>: ₹<?= $month['total_monthly_expense']; ?> (Max: ₹<?= $month['max_monthly_expense'] ?? 0; ?>)</p>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Expenses Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Expenses</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Amount</th>
                            <th class="border p-2">Date</th>
                            <th class="border p-2">Group</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($groups as $group) : ?>
                            <?php if ($group['expense_id']) : ?>
                                <tr class="bg-gray-100 text-center">
                                    <td class="border p-2"><?= $group['expense_name']; ?></td>
                                    <td class="border p-2">₹<?= $group['amount']; ?></td>
                                    <td class="border p-2"><?= $group['date']; ?></td>
                                    <td class="border p-2"><?= $group['group_name']; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Group-wise Expense Summary -->
<div class="mt-6 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Group-wise Expense Summary</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border p-2">Group</th>
                            <th class="border p-2">Total Expense</th>
                            <th class="border p-2">Max Expense</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $groupedExpenses = [];
                        foreach ($groups as $group) {
                            if (!isset($groupedExpenses[$group['group_name']])) {
                                $groupedExpenses[$group['group_name']] = [
                                    'total' => 0,
                                    'max' => 0
                                ];
                            }
                            $groupedExpenses[$group['group_name']]['total'] += $group['amount'] ?? 0;
                            $groupedExpenses[$group['group_name']]['max'] = max($groupedExpenses[$group['group_name']]['max'], $group['amount'] ?? 0);
                        }
                        ?>

                        <?php foreach ($groupedExpenses as $groupName => $data) : ?>
                            <tr class="bg-gray-100 text-center">
                                <td class="border p-2"><?= $groupName; ?></td>
                                <td class="border p-2">₹<?= $data['total']; ?></td>
                                <td class="border p-2">₹<?= $data['max']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</main>

<?php require BASE_PATH . "views/partials/footer.php"; ?>