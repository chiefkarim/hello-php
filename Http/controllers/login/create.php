<?php

use Core\Session;

$header = "Login";

view("login/create.view.php", ["errors" => Session::get('errors') ,"header" => $header,"email" => old('email')]);
