<?php

$header = "Register";
if ($_SESSION['email']) {
    header("Location: /");
}

view("register/index.view.php", ["errors" => $errors]);
