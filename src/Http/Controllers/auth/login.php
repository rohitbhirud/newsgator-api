<?php

use Core\App;
use Core\Database;

class LoginController
{
    function login()
    {
        $db = App::resolve(Database::class);
        $db->select('users', [
            'name',
            'email'
        ], function ($data) {
            return jsonResponse('users', $data);
        });
    }
}

return new LoginController();