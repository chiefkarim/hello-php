<?php

namespace Core\middleware;

class Auth
{
    public function handle()
    {
        if (! $_SESSION['email'] ?? false) {
            header("Location: /");
            exit();
        }
    }
}
