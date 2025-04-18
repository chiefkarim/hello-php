<?php

$header = "Register";
if (isset($_SESSION['email'])) {
    header("Location: /");
}

view("register/index.view.php", ["errors" => [],"header" => $header,"email" => null]);
