<?php
$header = "Tasks";
require "views/partials/head.php";
?>
    <script>
            function updateTask(taskId, currentStatus) {
                const newStatus = !currentStatus;
                fetch('/update.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                body: JSON.stringify({
                  id:taskId,
                  completed:currentStatus,
                })
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    }
                });
            }

        </script>


<table class="w-full border-collapse text-left">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="p-3 text-sm font-semibold text-gray-700">Title</th>
            <th class="p-3 text-sm font-semibold text-gray-700">Completed</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="p-3" colspan="2">
                <form method="POST" action="/insert.php" class="flex items-center gap-2">
                    <input 
                        type="text" 
                        name="title" 
                        placeholder="New task..."
                        class="border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
                    />
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">
                        Submit
                    </button>
                </form>
            </td>
        </tr>

        <?php foreach ($tasks as $task): ?>
        <tr class="hover:bg-gray-50">
            <td class="p-3">
                <a 
                    href="<?php echo "/task?id={$task['id']}"; ?>"
                    class="text-blue-600 hover:underline font-medium"
                >
                    <?php echo htmlspecialchars($task['title']) ?>
                </a>
            </td>
            <td class="p-3">
                <button 
                    onclick="updateTask(<?php echo $task['id']; ?>, <?php echo $task['completed'] ? 0 : 1; ?>); return false;"
                    class="text-lg"
                    title="Toggle completion"
                >
                    <?php echo $task['completed'] ? '✅' : '⬜'; ?>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require "views/partials/footer.php";
