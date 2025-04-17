<?php

use Core\Validator;
use Core\App;

$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

// validate data
$errors = [];

if (!Validator::email($email)) {
    $errors[] = "Please enter valid email!";
}
if (!Validator::string($password)) {
    $errors[] = "Password length must be between 1 and 255 characters!";
}
// if errors exist return to the user with the data he submited
if (!empty($errors)) {
    return  view("login/create.view.php", ["header" => "Login","errors" => $errors,"email" => $email]);
}


error_log("[DEBUG] validated " . $email . " config:" . json_encode([$config, $password, $username]));
try {

    // check if email exisist
    $database = App::resolve(\Core\Database::class);
    $sql = "SELECT * FROM users WHERE email=:email;";
    $stmt = $database->query($sql, ["email" => $email])->statment;
    $user = $stmt->fetch();
    error_log("[DEBUG] " . json_encode($user));
    if ($user) {
        // check if password matches
        if (password_verify($password, $user['password'])) {

            error_log("[DEBUG] password correct" . json_encode($user));
            $_SESSION['user'] = ["id" => $user['id'],"email" => $email];

            error_log("[DEBUG]session set " . json_encode($user));
            header("Location: /todos");
            exit();
        }
    }
    // return erro without revealing if the account exists
    $errors[] = "No matching account found with the entered email and Password!";
    return view("login/create.view.php", ["header" => "Login","errors" => $errors,"email" => $email]);
    exit();

} catch (PDOException  $pe) {
    error_log($pe);
    abort(Response::INTERNAL_SERVER_ERROR);
}





//store user in session return to the todos page if no errors
