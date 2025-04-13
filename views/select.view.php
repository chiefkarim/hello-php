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
                        class="border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-1 "
                    />
                    <button 
                        type="submit" 
                        class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">
                        Create Note
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
                    <?php echo $task['title']; ?>
                </a>
            </td>
            <td class="p-3 flex items-center gap-2">
                <button 
                    onclick="updateTask(<?php echo $task['id']; ?>, <?php echo $task['completed'] ? 0 : 1; ?>); return false;"
                    class="text-lg"
                    title="Toggle completion"
                >
                    <?php echo $task['completed'] ? '✅' : '⬜'; ?>
                </button>
  <form method="POST" action="/task-delete.php" data-confirm>
    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
    <button 
        type="submit"
        class="text-red-500 hover:text-red-700 text-sm"
        title="Delete note"
    >
        🗑️
    </button>
</form>
            </td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- 🔒 Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6">
    <h2 class="text-lg font-semibold mb-4 text-gray-800">Supprimer la note</h2>
    <p class="text-sm text-gray-600 mb-6">Es-tu sûr de vouloir supprimer cette note ? Cette action est irréversible.</p>
    <div class="flex justify-end gap-2">
      <button id="cancelBtn" class="px-4 py-1 rounded bg-gray-200 hover:bg-gray-300 text-gray-800">Annuler</button>
      <button id="confirmBtn" class="px-4 py-1 rounded bg-red-500 hover:bg-red-600 text-white">Supprimer</button>
    </div>
  </div>
</div>
<script>
  let targetForm = null;

  document.querySelectorAll('form[data-confirm]').forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      targetForm = form;
      document.getElementById('confirmModal').classList.remove('hidden');
    });
  });

  document.getElementById('cancelBtn').addEventListener('click', function () {
    document.getElementById('confirmModal').classList.add('hidden');
    targetForm = null;
  });

  document.getElementById('confirmBtn').addEventListener('click', function () {
    if (targetForm) {
      targetForm.submit();
    }
  });
</script>
 
<?php
require "views/partials/footer.php";
