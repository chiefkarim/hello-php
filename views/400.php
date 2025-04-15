<?php
$header = "404";
view("partials/head.php", ["header" => $header]);
?>
<h1>Bad request!</h1>
<?php
view("partials/footer.php");
