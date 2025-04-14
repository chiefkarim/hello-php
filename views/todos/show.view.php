<?php

$header = "Task";
view("partials/head.php", ["header" => $header]);
?>

<textarea class="p-4" ><?php echo $todo['title']; ?>
</textarea>

<?php
view("partials/footer.php");
