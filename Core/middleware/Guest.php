<?php

namespace Core\middleware;

class Guest
{
    public function handle()
    {
        if ($_SESSION['email'] ?? false) {
            header("Location: /");
            exit();
        }
    }
}
