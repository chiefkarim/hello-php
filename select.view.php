<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo</title>
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
    </head>
    <body>
        <table>
            <h1>My Todo</h1>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Completed</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['title']) ?></td>
                    <td>
                        <a href="#" onclick="updateTask(<?php echo $task['id']; ?>, <?php echo $task['completed'] ? 0 : 1; ?>); return false;">
                            <?php echo $task['completed'] ? '✅' : '⬜'; ?>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>

