<?php

use Http\Forms\LoginForm;
use Core\App;
use Core\Session;

$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

// validate data
$form = new LoginForm();

// if errors exist return to the user with the data he submited
if ($form->validate($email, $password)) {
    $authenticator = App::resolve(\Core\Authenticator::class)->auth($email, $password);
    if ($authenticator) {
        return redirect("/todos");
    }
    $form->error('error', "No matching account found with the entered email and Password!");
}

Session::flash("errors", $form->errors());
Session::flash("old", ["email" => $email]);

return redirect("/login");
