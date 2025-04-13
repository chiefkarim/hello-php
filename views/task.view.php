<?php

$header = "Task";
require "views/partials/head.php";
?>

<textarea class="p-4" ><?php echo $task['title']; ?>
</textarea>

<?php
require "views/partials/footer.php";
