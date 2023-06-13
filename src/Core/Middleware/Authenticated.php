<?php

namespace Core\Middleware;

class Authenticated
{
    public function handle()
    {
        if (!in_array('user', $_SESSION)) {
            jsonResponse('User not authenticated', null, null, 403);
            die();
        }
    }
}