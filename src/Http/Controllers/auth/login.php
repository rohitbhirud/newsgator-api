<?php

use Core\App;
use Core\Database;

class LoginController
{
    function login()
    {
        // validate request
        // if user exists and password is correct
        // return jwt token

        $db = App::resolve(Database::class);

        // Retrieve the input data
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $errors = [];

        // Check if email, password, or name is missing
        if (!$email || !$password) {
            $errors['missing_fields'] = 'Please provide all the required fields.';
            return jsonResponse('Validation failed', null, $errors, 400);
        }

        $user = $db->get(
            'users',
            '*'
            ,
            ['email' => $email]
        );

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return jsonResponse('Login successful');
            }
        }

        return jsonResponse('email or password is incorrect', null, [], 400);
    }

}

return new LoginController();