<?php

namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        if ($_SESSION['user'] ?? false) {
            jsonResponse('Please logout to access this route', null, null, 401);
            die();
        }
    }
}