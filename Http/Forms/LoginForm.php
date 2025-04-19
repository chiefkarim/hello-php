<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $password)
    {
        if (!Validator::email($email)) {
            $this->errors["email"] = "Please enter valid email!";
        }
        if (!Validator::string($password)) {
            $this-> errors["password"] = "Password length must be between 1 and 255 characters!";
        }
        return empty($this->errors);
    }
    public function errors()
    {
        return $this-> errors;
    }
    public function error($key, $message)
    {
        $this->errors[$key] = $message;
    }
}
