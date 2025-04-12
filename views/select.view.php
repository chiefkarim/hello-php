<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo</title>
<script src="https://cdn.tailwindcss.com"></script>
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
    <body class="h-full">
   <?php require("partials/nav.php"); ?>
 <header class="bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
<a href="/" >go to home page</a>
<a href="/chat" >go to chat page</a>
        <table>
            <h1>My Todo</h1>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Completed</th>
                </tr>
            </thead>
            <tbody>
        <tr
          <td>
            <form method="POST" action="/insert.php">
              <input type="text" name="title"/>
             <button type="submit">submit</button> 
            </form>            
          </td>
        </tr>
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
 
    </div>
  </main>
   </body>
</html>

