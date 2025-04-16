<?php

use Core\App;
use Core\Response;
use Core\Validator;

$email = trim(htmlspecialchars($_POST['email'])) ?? null;
$password = trim(htmlspecialchars($_POST['password'])) ?? null;

$errors = [];

if (!Validator::email($email)) {
    $errors[] = "Please enter valid email!";
}
if (!Validator::string($password)) {
    $errors[] = "Password length must be between 1 and 255 characters!";
}

// if errors exist return to the user with the data he submited
if (!empty($errors)) {
    view("register/index.view.php", ["header" => "Register","errors" => $errors,"email" => $email]);
    exit;
}


//  if email already exist and return error
try {
    $database = App::resolve(\Core\Database::class);
    $sql = "SELECT COUNT(*) FROM users WHERE email=:email;";
    $stmt = $database->query($sql, ["email" => $email])->statment;
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        $errors[] = "Email laready exists please login or choose another email!";
        view("register/index.view.php", ["header" => "Register","errors" => $errors,"email" => $email]);
    } else {
        // if email doesn't exist store it in the database
        $sql = "INSERT INTO users (email,password) VALUES(:email,:password);";
        $stmt = $database->query($sql, ["email" => $email,"password" => $password]);
        $_SESSION['email'] = $email;
        header("Location: /todos");
    }

} catch (PDOException  $pe) {
    erro_log($pe);
    abort(Response::INTERNAL_SERVER_ERROR);
}
