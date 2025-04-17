<?php

// get session params
$params = session_get_cookie_params();
// deelete session data and destroy it
session_unset();
session_destroy();
//remove user cookie
setcookie(session_name(), '', time() - 4200, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

// redirect to home page
header("Location: /");
