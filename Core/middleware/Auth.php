<?php

namespace Core\middleware;

class Auth
{
    public function handle()
    {
        if (isLoggedIn()) {
            return;
        }
        redirect("/");
    }
}
