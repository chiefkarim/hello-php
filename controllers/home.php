<?php
$header  = "Home";
view('partials/head.php', ["header" => $header]);
?>

<main><h1>Welcome  <?php echo $_SESSION['user']['email'] ?? "guest";?></h1></main>

<?php
view("partials/footer.php");
