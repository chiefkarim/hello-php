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
//if email has error return error
// if errors exist return to the user with the data he submited
if (!empty($errors)) {
    view("login/create.view.php", ["header" => "Login","errors" => $errors,"email" => $email]);
    exit;
}


// if password doesn't exist return error
try {
    $database = App::resolve(\Core\Database::class);
    $sql = "SELECT * FROM users WHERE email=:email;";
    $stmt = $database->query($sql, ["email" => $email])->statment;
    $data = $stmt->fetch();

    if (!$data) {
        $errors[] = "Email does not exists please register!";
        view("login/create.view.php", ["header" => "Login","errors" => $errors,"email" => $email]);
        exit();
    } else {
        // check if email exisist and password correct  and return errors acordingly or
        $login = password_verify($password, $data['password']);
        if ($login) {
            $_SESSION['user'] = ["id" => $data['id'],"email" => $email];
            header("Location: /todos");
            exit();
        } else {
            $errors[] = "Password is not correct, please try again!";
            view("login/create.view.php", ["header" => "Login","errors" => $errors,"email" => $email]);
            exit();
        }

    }

} catch (PDOException  $pe) {
    erro_log($pe);
    abort(Response::INTERNAL_SERVER_ERROR);
}





//store user in session return to the todos page if no errors
