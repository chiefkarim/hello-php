<?php

namespace Core;

class Authenticator
{
    public function auth($email, $password)
    {
        try {
            // check if email exisist
            $database = App::resolve(\Core\Database::class);
            $sql = "SELECT * FROM users WHERE email=:email;";
            $stmt = $database->query($sql, ["email" => $email])->statment;
            $user = $stmt->fetch();

            if ($user) {
                // check if password matches
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = ["id" => $user['id'],"email" => $email];
                    return true;
                }
                return false;
            }
            return false;
        } catch (PDOException  $pe) {
            error_log($pe);
            abort(Response::INTERNAL_SERVER_ERROR);
        }
    }
}
