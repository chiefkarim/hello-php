<?php

$header = "Register";

view("partials/head.php", ["header" => $header]);

view("register/register.view.php", ["errors" => $errors]);

view("partials/footer.php");
