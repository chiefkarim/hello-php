<?php

namespace Core\middleware;

class Guest
{
    public function handle()
    {
        if (isLoggedIn()) {
            redirect("/");
        }
    }
}
