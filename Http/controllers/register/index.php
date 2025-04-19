<?php

$header = "Register";
if (isset($_SESSION['email'])) {
    redirect("/");
}

view("register/index.view.php", ["errors" => [],"header" => $header,"email" => null]);
