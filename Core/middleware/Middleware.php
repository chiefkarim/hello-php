<?php

namespace Core\middleware;

class Middleware
{
    public const MAP = [
    "auth" => Auth::class,
    "guest" => Guest::class,
    ];
}
