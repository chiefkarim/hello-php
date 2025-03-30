<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo</title>
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
                    <td><?php echo $task['title'] ?></td>
                    <td><?php echo $task['completed'] ? '✅' : '⬜' ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>

</html>
