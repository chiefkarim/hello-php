<?php

use Http\Forms\LoginForm;
use Core\App;
use Core\Response;

$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

// validate data
$form = new LoginForm();

// if errors exist return to the user with the data he submited
if (!$form->validate($email, $password)) {
    return  view("login/create.view.php", ["header" => "Login","errors" => $form->errors(),"email" => $email]);
}

$authenticator = App::resolve(\Core\Authenticator::class)->auth($email, $password);
if ($authenticator) {
    header("Location: /todos");
    exit();
}

// return erro without revealing if the account exists
$errors[] = "No matching account found with the entered email and Password!";
return view("login/create.view.php", ["header" => "Login","errors" => $errors,"email" => $email]);
exit();
