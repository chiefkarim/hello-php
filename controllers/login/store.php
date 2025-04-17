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


try {

    // check if email exisist
    $database = App::resolve(\Core\Database::class);
    $sql = "SELECT * FROM users WHERE email=:email;";
    $stmt = $database->query($sql, ["email" => $email])->statment;
    $user = $stmt->fetch();

    if ($user) {
        // check if password matches
        if (password_verify($password, $data['password'])) {
            $_SESSION['user'] = ["id" => $data['id'],"email" => $email];
            header("Location: /todos");
            exit();
        }
    }
    // return erro without revealing if the account exists
    $errors[] = "No matching account found with the entered email and Password!";
    return view("login/create.view.php", ["header" => "Login","errors" => $errors,"email" => $email]);
    exit();

} catch (PDOException  $pe) {
    erro_log($pe);
    abort(Response::INTERNAL_SERVER_ERROR);
}





//store user in session return to the todos page if no errors
